<?php

namespace TimeNormalize\Validator;

use Zend\Validator\AbstractValidator;
use DateTime;
use DateTimeZone;

class Time extends AbstractValidator {

    const INVALID = 'timeInvalid';

    /**
     * @var array
     */
    protected $messageTemplates = [
        self::INVALID => "The time should look something like '12:30 AM' or '12:30'",
    ];

    /**
     * @var array
     */
    protected $options = [
        'formats' => ['H', 'Hi', 'H:i', 'h:i a'],
    ];

    /**
     * Options:
     * 'formats' => array
     *
     * @param array $options OPTIONAL
     */
    public function __construct($options = []) {
        parent::__construct($options);
    }

    public function getFormats() {
        return $this->options['formats'];
    }

    /**
     * @param string $value
     * @return boolean
     */
    public function isValid($value) {
        if (!is_string($value)) {
            $this->error(self::INVALID);
            return false;
        }
        $this->setValue($value);

        foreach ($this->getFormats() as $format) {
            $result = DateTime::createFromFormat(
            $format, $value, new DateTimeZone('UTC')
            );
            if ($result) {
                return true;
            }
        }

        $this->error(self::INVALID);
        return false;
    }

}
