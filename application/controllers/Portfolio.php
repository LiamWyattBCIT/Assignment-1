<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//NOTE that it extends application, not CI_CONTROLLER

class Portfolio extends Application {
	function __construct(){
		parent::__construct();
	}
	

	public function index($name)
	{
            //code igniter url
            //fetch the pathname, explode it, use the name value at the end
            
		//uncommenting these lines makes it seem like you are logged in,
		//to see what it looks like 
		$_SESSION['loggedIn'] = true;
		$_SESSION['username'] = 'Mickey';
		
		$this->data['pagebody'] = 'portfolio'; //setting view to use
		$this->data['title'] = 'Portfolio'; //Changing nav bar to show page title

		$table1 = "";
		$collection = $this->collections->collection_by_player($name);
                
                $table2 = "";
                $transaction =  $this->transactions->transactions_by_player($name);
                
                if ($collection != null) {
		
                    foreach($collection as $row){
                            $table1 .= "<div>Player " . $row['Player'] . " has piece " . $row['Piece'] . " with token " . $row['Token'] . " from the time of " . $row['Datetime'] . "</div>";
                    }

                    $this->data['inventory_table'] = $table1;
                    
                    foreach($transaction as $row){
			$table2 .= '<div>Player ' . $row['Player'] . ' has ' . $row['Trans'] . ' series ' . $row['Series'] . ' on ' . $row['DateTime'] . '<br></div>';
                    }
                    
                    $this->data['activity_feed'] = $table2;
                    
                    $this->Render();
                } else {
                    $string = ('This person does not exist within the game.');
                    $this->data['inventory_table'] = $string;
                    $this->data['activity_feed'] = null;
                    $this->Render();
                }
	}

}
