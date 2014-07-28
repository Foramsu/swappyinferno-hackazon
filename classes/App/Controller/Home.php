<?php
namespace App\Controller;

use App\Model\Product as Product;
use \App\Model\Category as Category;
use \App\Model\SpecialOffers as SpecialOffers;

class Home extends \App\Page {

    const COUNT_RND_PRODUCTS = 3; //count products for rnd block of main page

    /**
     * @var int Count of products in top viewed products on homepage.
     */
    protected $topViewedCount = 5;

    /**
     * @var int Count of products in related to visited products on homepage.
     */
    protected $relatedToVisitedCount = 10;

    /**
     * @var int Count of products in best choice block on homepage.
     */
    protected $bestChoiceCount = 5;

    /**
     * @var int Count of reviews on homepage.
     */
    protected $reviewsCount = 5;


	public function action_index()
    {
        $category = new Category($this->pixie);
        $product = new Product($this->pixie);
        $special_offers = new SpecialOffers($this->pixie);
        $this->view->sidebar = $category->getRootCategoriesSidebar();
        $this->view->rnd_products = $product->getRndProduct(self::COUNT_RND_PRODUCTS);
        $this->view->topViewedProducts = $product->getRandomProducts($this->topViewedCount);
        $this->view->topViewedProducts = $product->getRandomProducts($this->topViewedCount);
        $this->view->relatedToVisitedProducts = $product->getRandomProducts($this->relatedToVisitedCount);
        $this->view->bestChoiceProducts = $product->getRandomProducts($this->bestChoiceCount);

        $this->view->special_offers = $special_offers->getSpecialOffersList()->as_array();
        $this->view->common_path = $this->common_path;
		$this->view->subview = 'home/home';
		$this->view->message = "Index page";
	}
	
    public function action_404()
    {
		$this->view->subview = '404';
		$this->view->message = "Index page";
	}
        
    public function action_install()
    {
            //$this->view->subview = '';
            //Remove tables
            $tables = $this->pixie->db->get()->execute("SELECT GROUP_CONCAT(table_name) as tbl FROM information_schema.tables  WHERE table_schema = (SELECT DATABASE())");
            $tblRemove = "";
            foreach($tables as $table){
                if($table->tbl != "")
                    $tblRemove = "DROP TABLE IF EXISTS " . $table->tbl;
            }
            
            if($tblRemove != "") $this->pixie->db->get()->execute($tblRemove);

            //Install schema
            $dbScript = $this->pixie-> root_dir . "database/db.sql";

            $this->pixie->db->get()->conn->exec(file_get_contents($dbScript));
  
            $demoScript = $this->pixie-> root_dir . "database/demo_database.sql";
            $this->pixie->db->get()->conn->exec(file_get_contents($demoScript));
            
            foreach(scandir($this->pixie-> root_dir . "database/migrations") as $file){
                $file = $this->pixie-> root_dir . "database/migrations/" . $file;
                if(is_file($file)){
                    $this->pixie->db->get()->conn->exec(file_get_contents($file));
                }
            }

            return $this->redirect('/');

	}

    /**
     * @return int
     */
    public function getBestChoiceCount()
    {
        return $this->bestChoiceCount;
    }

    /**
     * @param int $bestChoiceCount
     */
    public function setBestChoiceCount($bestChoiceCount)
    {
        $this->bestChoiceCount = $bestChoiceCount;
    }

    /**
     * @return int
     */
    public function getRelatedToVisitedCount()
    {
        return $this->relatedToVisitedCount;
    }

    /**
     * @param int $relatedToVisitedCount
     */
    public function setRelatedToVisitedCount($relatedToVisitedCount)
    {
        $this->relatedToVisitedCount = $relatedToVisitedCount;
    }

    /**
     * @return int
     */
    public function getReviewsCount()
    {
        return $this->reviewsCount;
    }

    /**
     * @param int $reviewsCount
     */
    public function setReviewsCount($reviewsCount)
    {
        $this->reviewsCount = $reviewsCount;
    }

    /**
     * @return int
     */
    public function getTopViewedCount()
    {
        return $this->topViewedCount;
    }

    /**
     * @param int $topViewedCount
     */
    public function setTopViewedCount($topViewedCount)
    {
        $this->topViewedCount = $topViewedCount;
    }
}