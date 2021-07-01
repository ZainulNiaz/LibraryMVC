<?php

namespace Controller;
session_start();

class Logout {
    public function get() {
        session_destroy();
        header("Location: /");

    }

  
}