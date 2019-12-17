<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 24.11.19
 * Time: 10:01
 */

namespace validator;


use domain\Content;
use domain\Status;

class ContentValidator
{
    private $valid = true;
    private $userValidatedError = null;
    private $categorySetError = null;

    public function __construct(Content $content = null)
    {
        if (!is_null($content)) {
            $this->validate($content);
        }
    }

    public function validate(Content $content)
    {
        if (!is_null($content)) {
            if ($content->getStatus() == Status::PUBLISHED AND !$content->getAuthor()->getVerfied()) {
                $this->userValidatedError = 'You must first verify your e-mail address before you can publish.<br> Store your article as a draft until then.';
                $this->valid = false;
            }
            if (empty($content->getCategory())) {
                $this->categorySetError = 'You must select a category from the dropdown.';
                $this->valid = false;
            }

        } else {
            $this->valid = false;
        }
        return $this->valid;

    }

    public function isValid()
    {
        return $this->valid;
    }

    public function isUserVerifiedError()
    {
        return isset($this->userValidatedError);
    }

    public function getUserVerifiedError()
    {
        return $this->userValidatedError;
    }
    public function isCategorySetError()
    {
        return isset($this->categorySetError);
    }

    public function getCategorySetError()
    {
        return $this->categorySetError;
    }


}