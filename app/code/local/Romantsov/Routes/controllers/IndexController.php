<?php
    class Romantsov_Routes_IndexController extends mage_Core_Controller_Front_Action {
        public function indexAction(){
            $this->loadLayout();
            $this->renderLayout();
        }

        public function secondAction(){
            $this->loadLayout();
            $this->renderLayout();
        }
    }