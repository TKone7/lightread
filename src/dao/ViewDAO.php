<?php


namespace dao;

use domain\Content;
use domain\User;
use domain\View;

class ViewDAO extends BasicDAO
{

    public function register(View $view) {
        $stmt = $this->pdoInstance->prepare('
        INSERT INTO tbl_views (fld_user_id, fld_cont_id, fld_view_ip, fld_view_country, fld_view_city, 
                               fld_view_os, fld_view_browser, fld_view_browservrs, fld_view_pit)
          values(:user_id, :cont_id, :ip,  :country, :city, :os, :browser, :browservrs, :pit)');
        $u = !is_null($view->getUser()->getId()) ? $view->getUser()->getId() : NULL;
        $stmt->bindParam(':user_id', $u);
        $stmt->bindValue(':cont_id', $view->getContent()->getId());
        $stmt->bindValue(':ip', $view->getIp());
        $stmt->bindValue(':country', $view->getCountry());
        $stmt->bindValue(':city', $view->getCity());
        $stmt->bindValue(':os', $view->getOs());
        $stmt->bindValue(':browser', $view->getBrowser());
        $stmt->bindValue(':browservrs', $view->getBrowserVersion());
        date_default_timezone_set('Europe/Zurich');
        $stmt->bindValue(':pit', $timestamp = date('Y-m-d H:i:s'));
        $stmt->execute();
    }


    public function readLast(User $user, Content $content, $ip, $city, $country, $os, $browser, $browserversion) {

        if(!is_null($user->getId())) {
            //check by user_id
            $stmt = $this->pdoInstance->prepare('
                SELECT MAX(fld_view_pit) as view_pit FROM tbl_views 
                WHERE fld_user_id = :user_id AND fld_cont_id = :cont_id;');
            $stmt->bindValue(':user_id', $user->getId());
            $stmt->bindValue(':cont_id', $content->getId());

        } else {
            //check by spied data
            $stmt = $this->pdoInstance->prepare('
                SELECT MAX(fld_view_pit) as view_pit FROM tbl_views
                WHERE fld_cont_id = :cont_id AND fld_view_ip = :ip AND fld_view_city = :city AND
                      fld_view_country = :country AND fld_view_os = :os AND fld_view_browser = :browser AND fld_view_browservrs = :browservrs;');
            $stmt->bindValue(':cont_id', $content->getId());
            $stmt->bindParam(':ip', $ip);
            $stmt->bindParam(':country', $country);
            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':os', $os);
            $stmt->bindParam(':browser', $browser);
            $stmt->bindParam(':browservrs', $browserversion);
        }

        $stmt->execute();
        $pit = $stmt->fetchAll(\PDO::FETCH_ASSOC)[0]['view_pit'];

        return $pit;
    }

}