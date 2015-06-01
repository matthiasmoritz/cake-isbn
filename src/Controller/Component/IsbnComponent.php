<?php
namespace Isbn\Controller\Component;

use Cake\Controller\Component;
use Cake\Core\Plugin;



/**
* Cake-Isbnr - a CakePHP component to work with ISBN
*
* @package Isbn
* @version Release: 1.0
* @author Matthias Moritz <moritz370@googlemail.com>
* @link 
*/
class IsbnComponent extends Component
{
    public $helpers = ['Html'];
    

    private function getGroupNumber($isbn){
        $lengr = 0;
        if (preg_match("/978[0-5^7][0-9]{9}/", $isbn)){
            $lengr = 1;
        }
        if (preg_match("/978([8][0-9]|[9][0-4])[0-9]{8}/", $isbn)){
            $lengr = 2;
        }
        if (preg_match("/97910[0-9]{8}/", $isbn)){
            $lengr = 2;
        }
        if (preg_match("/978(6[0-4][0-9]|9[5-8][0-9])[0-9]{7}/", $isbn)){
            $lengr = 3;
        }
        if (preg_match("/97899[0-8][0-9][0-9]{6}/", $isbn)){
            $lengr = 4;
        }
        if (preg_match("/978999[0-9][0-9][0-9]{5}/", $isbn)){
            $lengr = 5;
        }        
        return (substr($isbn, 3, $lengr));
    }
    
    private function getPublisherNumber($isbn){
        
   
        $groupnumber = $this->getGroupNumber($isbn);
        $number = substr($isbn, 3+strlen($groupnumber), -2)+0;
        $xml = simplexml_load_file(Plugin::path('Isbn').'webroot'. DS .'files'. DS .'RangeMessage.xml');
        foreach ($xml->RegistrationGroups->Group as $i){
            if ('978-'.$groupnumber == $i->Prefix){
                foreach ($i->Rules->Rule as $j){
                    $limits = (explode("-",$j->Range));
                    $lengpub = $j->Length[0]+0;
                    $minimum = $limits[0]+0;
                    $maximum = $limits[1]+0;

                    if ($number >= $minimum and $number <= $maximum){
                        $rv = (substr($isbn, 3+strlen($groupnumber), $lengpub));
                        return $rv;
                    }
                }
            }
        }
    }
    

/**
* Splits a valid ISBN-13 Number in its components
*
* @param string $input The ISBN Numeber.
* @return array['bookland']['publisherNumber']['ArticleNumber']['Checksum']
* @access public
* @throws NO ERROR HANDLING
* */
    public function splitIsbn($isbn){
        $prefix         = substr($isbn, 0,3);
        $groupnumber    = $this->getGroupNumber($isbn);
        $pubnumber      = $this->getPublisherNumber($isbn);
        $prenumbers     = strlen($groupnumber)+strlen($pubnumber)+3;
        $articleNumber  = substr($isbn, $prenumbers, -1);
        $checkdigit     = substr($isbn, -1);
        return (array($prefix, $groupnumber, $pubnumber, $articleNumber, $checkdigit));        
    }

}

?>
