<?php

namespace App\Request;


class Request
{
    private array $data;
    protected array $requires = [];
    public array $errors = [];

    public function __construct(public array $request)
    {
        $this->setData();
    }

    public function __toString()
    {
        return $this->data;
    }

    public function __get($key)
    {
        if (!isset($this->data[$key])) throw new \Exception("invalid property" . $key);

        return $this->data[$key];
    }

    public function setData()
    {
        if (!empty($this->requires)) {
            foreach ($this->requires as $value) {
                if (isset($this->request[$value]) && !empty($this->request[$value])) {
                    $this->data[$value] = trim($this->request[$value]);
                } else {
                    $this->errors[$value] = "property $value is required";
                }
            }
        } else {
            $this->data = $this->request;
        }
    }
}
