    <?php
    class Romantsov_Weblog_IndexController extends Mage_Core_Controller_Front_Action {
        public function onePostAction(){
            $params = $this->getRequest()->getParams();
            $blogpost = Mage::getModel('weblog/blogpost');
            $blogpost->load($params['id']);
            echo $blogpost->getTitle();
        }

        public function allPostsAction(){
            $blogposts = Mage::getModel('weblog/blogpost')->getCollection();
            foreach ($blogposts as $blogpost){
                echo $blogpost->getTitle() . '<br>';
            }
        }
    }