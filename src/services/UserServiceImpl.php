<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 13.11.19
 * Time: 13:05
 */

namespace services;

use dao\PaymentDAO;
use dao\WithdrawalDAO;
use domain\Purpose;
use domain\User;
use dao\UserDAO;
use http\HTTPException;
use http\HTTPStatusCode;
use view\TemplateView;

class UserServiceImpl implements UserService
{
    private static $instance = NULL;

    protected function __construct()
    {
    }

    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Create a new user.
     *
     * Creates a new user into the db and triggers a verification email when address is supplied.
     * @param User $user
     * @return User
     */
    public function createUser(User $user) {
        $userdao = new UserDAO();
        $new_user = $userdao->create($user);
        if(!empty($new_user->getEmail())){
            $this->sendVerificationMail($new_user);
        }
        return $new_user;
    }

    /**
     * Update a user.
     *
     * Updates the user on the database. If email address has changed, a re-verification is triggered.
     * @param User $olduser
     * @param User $user
     * @return User|null
     * @throws HTTPException
     */
    public function updateUser(User $olduser, User $user)
    {
        if(AuthServiceImpl::getInstance()->verifyAuth()){
            $userdao = new UserDAO();
            if($user->getId()==(AuthServiceImpl::getInstance())->getCurrentUserId()){
                if(!is_null($user->getPassword())){
                    $userdao->updatePassword($user);
                }
                if(empty($user->getEmail())){
                    // cannot be verified without email address
                    $user->setVerfied(false);
                }else{
                    if($olduser->getEmail() !== $user->getEmail()){
                        // email has changed and triggers re-verification
                        $user->setVerfied(false);
                        $this->sendVerificationMail($user);
                    }
                }
                return $userdao->update($user);
            }
        }
        throw new HTTPException(HTTPStatusCode::HTTP_401_UNAUTHORIZED);
    }

    /**
     * Get user object by ID
     *
     * @param $id
     * @return User|null
     */
    public function readUser($id)
    {
        $userdao = new UserDAO();
        return $userdao->read($id);
    }


    /**
     * @param User $user
     * @param Purpose|NULL $purpose
     * @return float
     */
    public function getTurnover(User $user, Purpose $purpose = NULL){
        $paym_dao = new PaymentDAO();
        return $paym_dao->selectUserTurnover($user,$purpose);
    }

    public function getAggrWithdrawal(User $user){
        $wdrw_dao = new WithdrawalDAO();
        return $wdrw_dao->selectUserWithdrawal($user);
    }

    // returns an array of transactions on the user's balance
    public function getBalanceHistory(User $user){
        $pdao = new PaymentDAO();
        $wdao = new WithdrawalDAO();
        $paymentHist = $pdao->selectByReceiver($user);
        $withdrawalHist = $wdao->selectByWithdrawer($user);
        return array_merge($paymentHist, $withdrawalHist);
    }

    // returns an array of purchase transactions made by the user
    public function getPurchaseHistory(User $user){
        $pdao = new PaymentDAO();
        $purchaseHist = $pdao->selectByPayer($user);
        return $purchaseHist;
    }

    /**
     * Send a verfication email to the user.
     *
     * @param User $user
     */
    public function sendVerificationMail(User $user){
        $emailView = new TemplateView("emailVerificationEmail.php");
        $emailView->verifyLink = $GLOBALS["ROOT_URL"] . "/confirm_mail/?cfm=" .$this->getUserHash($user) . '&id=' . $user->getId();
        EmailServiceClient::sendEmail($user->getEmail(), 'Verify your email on Lightread',$emailView->render());
    }

    /**
     * Create a deterministic user hash.
     *
     * Creates a hash for a given user that includes email address, users creation date and id.
     * This allows the comparison later to verify hash provided by the user.
     * @param User $user
     * @return string
     */
    public function getUserHash(User $user)
    {
        $hash_msg = array(
            'mail' => $user->getEmail(),
            'creation' => $user->getCreationDate(),
            'id' => $user->getId());
        return hash('sha256', json_encode($hash_msg));
    }

    /**
     * Validates a hash provided by the user.
     *
     * Checks if the provided hash is valid for this user and email address.
     * @param User $user
     * @param string $hash
     * @return bool
     */
    public function validateMailHash(User $user, $hash){
        $result =  hash_equals($this->getUserHash($user), $hash);
        if ($result){
            $user->setVerfied(true);
            (new UserDAO())->update($user);
        }
        return $result;
    }


}