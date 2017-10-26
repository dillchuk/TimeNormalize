<?php

namespace TimeNormalize\Filter;

use DateTime;
use DateTimeZone;
use Zend\Filter\AbstractFilter;

/**
 * Converts time to a normalized format, if possible.
 */
class Time extends AbstractFilter {

    /**
     * @var string
     */
    protected $formatOut = 'H:i';

    /**
     * @var array of strings
     */
    protected $formatsIn = ['H', 'Hi', 'H:i', 'h:i a'];

    /**
     * Allowed options are
     *     'formatOut', 'formatsIn'
     *
     * @param  string|array $options
     */
    public function __construct($options = null) {
        if (!is_array($options)) {
            $options = func_get_args();
            $temp['formatOut'] = array_shift($options);
            if (!empty($options)) {
                $temp['formatsIn'] = array_shift($options);
            }
            $options = $temp;
        }

        if (isset($options['formatOut'])) {
            $this->setFormatOut($options['formatOut']);
        }

        if (isset($options['formatsIn'])) {
            $this->setFormatsIn($options['formatsIn']);
        }
    }

    public function setFormatOut($formatOut) {
        $this->formatOut = $formatOut;
    }

    public function setFormatsIn(array $formatsIn) {
        $this->formatsIn = $formatsIn;
    }

    /**
     * @param mixed $value
     * @return mixed
     */
    public function filter($value) {
        foreach ($this->formatsIn as $format) {
            $result = DateTime::createFromFormat(
            $format, (string) $value, new DateTimeZone('UTC')
            );
            if (method_exists($result, 'format')) {
                return $result->format($this->formatOut);
            }
        }
        return $value;
    }

}
