<?php
class FormInputFactory{
    public static function create( $type, array $class = null ) {
    	if ( $class == null ){
      	return new FormInputFactory_row($type);
        }
      elseif( $class != null && is_array($class) ){
        return new FormInputFactory_name($type, $class);
      }
    }
}

class FormInputFactory_row{
    private $type;
    private $rowCount;

    function __construct($type) {
    	$this->type = $type;
    }

    public function setRows($rowCount){
    	$this->rowCount = $rowCount;
        return new FormInputFactory_name($this->type, $this->rowCount);
    }
}

class FormInputFactory_name{
    private $type;
    private $rowCount;
    private $class;
    private $output;

    function __construct($type, $rowCountOrClass) {
    	$this->type = $type;
    	if( is_int($rowCountOrClass) ){
        	$this->rowCount = $rowCountOrClass;
        }
        else{
        	$this->class = $rowCountOrClass;
        }
    }

    public function setName($name){
      $type = $this->type;
      if ( $this->class == null){
      	$rowCount = $this->rowCount;
        $this->output = '<' . $type . ' name="' . $name . '" rows="' . $rowCount . '"></' . $type . '>';
      }
      else{
      	
      	$class = $this->class;
        $this->output = '<input type="' . $type . '" class="' . $class['class'] . '" name="' . $name . '">';
      }
      return new writeClass($this->output);
    }
}

class writeClass{
	private $output;

    function __construct($output){
    	$this->output = $output;
    }

    public function write(){
    	return $this->output;
    }
}


$html[] = FormInputFactory::create("text", ["class"=>"primary"])->setName("uname");

$html[] = FormInputFactory::create("textArea")->setRows(4)->setName("description");

foreach( $html as $li) {
	echo $li->write();
}
?>
