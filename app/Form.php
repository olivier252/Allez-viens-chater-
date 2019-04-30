<?php

namespace Oliv\app;

class Form

{
    private $balise = "div";
    private $data;

    public function __construct($data =[])
    {
        $this->data = $data;
    }

    public function addDiv($html):string
    {
        return <<<HTML
        <{$this->balise} class="form-group">{$html}</{$this->balise}>
HTML;
    }

    public function getIndexName($index):string
    {
        return isset($this->data[$index]) ? $this->data[$index] : '';
    }


    public function input($placeholder, $name, $data_Err):string
    {
        $input = $this->addDiv('<input type="text" class="form-control"  name ="' . $name . '" placeholder="' . $placeholder . '" 
        value="' . $this->getIndexName($name) . '">');

        if (isset($data_Err[$name])) {
            echo $data_Err[$name];
        }
        return $input;
    }

    public function textarea($placeholder, $name, $data_Err):string
    {
        $textarea = $this->addDiv('<textarea class="form-control" name ="' . $name . '" placeholder="' . $placeholder . '"
        ></textarea>');

        if (isset($data_Err[$name])) {
            echo $data_Err[$name];
        }
        return $textarea;
    }

    public function button()
    {
        return '<button type="submit" class="btn btn-primary">Envoi</button>';
    }
}