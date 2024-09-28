<?php

class RedirectDeletedProcess {
    public function plugins_loaded()     {
        require_once QA_INCLUDE_DIR . 'app/page.php';

        $requestlower = strtolower(qa_request());
        $requestparts = qa_request_parts();
        $firstlower = strtolower($requestparts[0]);
        $routing = qa_page_routing();

        if (isset($routing[$requestlower])) {
            return;
        }

        if ($firstlower === 'user' && isset($requestparts[1])) {
            $account = qa_db_single_select(qa_db_user_account_selectspec($requestparts[1], false));
            if (!is_array($account)) {
                $this->redirectTo('users');
            }
        }

        if (!isset($routing[$firstlower . '/']) && is_numeric($requestparts[0])) {
            $question = qa_db_single_select(qa_db_full_post_selectspec(qa_get_logged_in_userid(), $requestparts[0]));
            if (!isset($question)) {
                $this->redirectTo('questions');
            }
        }
    }

    private function redirectTo($location)     {
        header("HTTP/1.1 301 Moved Permanently");
        qa_redirect($location);
    }
}