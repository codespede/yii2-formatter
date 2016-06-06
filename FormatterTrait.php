<?php
/**
 * @package   yii2-formatter
 * @author    Mahesh S Warrier <maheshs60@gmail.com>
 * @copyright Copyright &copy; Mahesh S Warrier, 2016
 * @version   1.0.0
 */
namespace common\traits\base;

trait FormatterTrait{
    public $formats = [
    		'date' => 'jS F, Y',
    		'money' = > '%.2n',
    	];
    private $methods;
    public function __get($name){
        $this->methods = get_class_methods($this);
        foreach($this->methods as $method){
            $key = lcfirst(str_replace("get", "", $method));
            if(strpos($name, $key) !== FALSE){ 
                $actualValue = $this->{lcfirst(str_replace($key, "", $name))};
                return $this->{"get".ucfirst($key)}($actualValue);
            }
        }
        return parent::__get($name);
    }

    public function getDateFormatted($value){
        return date($this->formats['date'], strtotime($value));
    }

    public function getMoneyFormatted($value){
        return money_format($this->formats['money'], $value);
    }
}
