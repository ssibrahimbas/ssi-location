<?php

namespace global;

class ValidationError
{
    public string $field;
    public string $message;

    public function __construct(string $field, string $message)
    {
        $this->field = $field;
        $this->message = $message;
    }
}

class Validation
{
    protected array $patterns = [
        'uri' => '[A-Za-z0-9-\/_?&=]+',
        'url' => '[A-Za-z0-9-:.\/_?&=#]+',
        'alpha' => '[\p{L}]+',
        'words' => '[\p{L}\s]+',
        'alphanum' => '[\p{L}0-9]+',
        'int' => '[0-9]+',
        'float' => '[0-9\.,]+',
        'tel' => '[0-9+\s()-]+',
        'text' => '[\p{L}0-9\s-.,;:!"%&()?+\'°#\/@]+',
        'file' => '[\p{L}\s0-9-_!%&()=\[\]#@,.;+]+\.[A-Za-z0-9]{2,4}',
        'folder' => '[\p{L}\s0-9-_!%&()=\[\]#@,.;+]+',
        'address' => '[\p{L}0-9\s.,()°-]+',
        'date_dmy' => '[0-9]{1,2}\-[0-9]{1,2}\-[0-9]{4}',
        'date_ymd' => '[0-9]{4}\-[0-9]{1,2}\-[0-9]{1,2}',
        'email' => '[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+[.]+[a-z-A-Z]'
    ];

    public array $errors = [];
    private string $name;
    private mixed $base;

    #[Pure] public function in(mixed $base): Validation
    {
        $this->base = $base;
        return $this;
    }

    public function addError(ValidationError $error): void
    {
        $this->errors[] = $error;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function isSuccess(): bool
    {
        return empty($this->errors);
    }

    public function reset(): void
    {
        $this->errors = [];
    }

    public function name(string $name): Validation
    {
        $this->name = $name;
        return $this;
    }

    public function pattern(string $pattern): Validation
    {
        if ($pattern == 'array') {
            if (!is_array($this->base[$this->name])) {
                $this->addError(new ValidationError($this->name, $this->name . ' is not valid.'));
            }
        } else {
            $regex = '/^(' . $this->patterns[$pattern] . ')$/u';
            if ($this->base[$this->name] != '' && !preg_match($regex, $this->base[$this->name])) {
                $this->addError(new ValidationError($this->name, $this->name . ' is not valid.'));
            }
        }
        return $this;
    }

    public function required(): Validation
    {
        if (!isset($this->base[$this->name]) || $this->base[$this->name] == '' || $this->base[$this->name] == null) {
            $this->addError(new ValidationError($this->name, $this->name . ' is required.'));
        }
        return $this;
    }

    public function contains(array $arr): Validation
    {
        if (!in_array($this->base[$this->name], $arr)) {
            $this->addError(new ValidationError($this->name, $this->name . ' is not valid.'));
        }
        return $this;
    }

    public function max(int $max): Validation
    {
        if ($this->base[$this->name] > $max) {
            $this->addError(new ValidationError($this->name, "The ".$this->name . ' field can be up to ' . $max));
        }
        return $this;
    }

    public function min(int $min): Validation
    {
        if ($this->base[$this->name] < $min) {
            $this->addError(new ValidationError($this->name, "The ".$this->name . ' field can be at least ' . $min));
        };
        return $this;
    }

    public function maxlength(int $length): Validation
    {
        if (strlen($this->base[$this->name]) > $length) {
            $this->addError(new ValidationError($this->name, "The ".$this->name . ' field can be up to ' . $length." characters."));
        }
        return $this;
    }

    public function minlength(int $length): Validation
    {
        if (strlen($this->base[$this->name]) < $length) {
            $this->addError(new ValidationError($this->name, "The ".$this->name . ' field can be at least ' .$length." characters."));
        }
        return $this;
    }

    public function equal(mixed $value): Validation
    {
        if ($this->base[$this->name] != $value) {
            $this->addError(new ValidationError($this->name, $this->name . ' is not valid.'));
        }
        return $this;
    }
}