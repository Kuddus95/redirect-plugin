<?php

if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
    header('Location: ../../');
    exit;
}
qa_register_plugin_module('process', 'RedirectDeletedProcess.php', 'RedirectDeletedProcess', 'Redirect Deleted Process');