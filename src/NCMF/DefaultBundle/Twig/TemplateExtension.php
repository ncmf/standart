<?php

namespace NCMF\DefaultBundle\Twig;

use Symfony\Bridge\Monolog\Logger;


class TemplateExtension extends \Twig_Extension
{

    private $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }


    public function getFunctions()
    {
        return array(
            'typograf' => new \Twig_Function_Method($this, 'typograf'),
        );
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('date_int', array($this, 'date_int')),
        );
    }

    public function typograf($text){
        $typograph = new \Emuravjev\Mdash\Typograph();
        $options = array(
            'Text.paragraphs'=>'off',
            'Text.breakline' => 'off'
        );
        $typograph->setup($options);
        $typograph->set_text($text);
        $result = $typograph->apply();
        return $result;
    }


    public function date_int(\DateTime $date, $format = 'j {n} Y H:i', $form = 2)
    {

        $result = $date->format($format);
        $n = $date->format('n');
        $m = $n - 1;
        $months = array(
            1 => array(
                'Январь',
                'Февраль',
                'Март',
                'Апрель',
                'Май',
                'Июнь',
                'Июль',
                'Август',
                'Сентябрь',
                'Октябрь',
                'Ноябрь',
                'Декабрь',
            ),
            2 => array(
                'Января',
                'Февраля',
                'Марта',
                'Апреля',
                'Мая',
                'Июня',
                'Июля',
                'Августа',
                'Сентября',
                'Октября',
                'Ноября',
                'Декабря',
            ),
            3 => array(
                'Январе',
                'Феврале',
                'Марте',
                'Апреле',
                'Мае',
                'Июне',
                'Июле',
                'Августе',
                'Сентябре',
                'Октябре',
                'Ноябре',
                'Декабре',
            )
        );
        $langMonth =  $months[$form][$m];
        $result = str_replace('{'.$n.'}', $langMonth, $result);
        return $result;
    }
}