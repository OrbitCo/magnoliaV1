<?php

namespace Pg\Libraries\View\Driver\Twig;

class Extension extends \Twig_Extension
{
    const NAME = 'PG';

    public function getName(): string
    {
        return self::NAME;
    }

    public function getFunctions(): array
    {
        return [];
    }

    public function getFilters(): array
    {
        return [];
    }

    public function getTokenParsers(): array
    {
        return [new Tokens\Helper\Parser()];
    }

    public function getOperators(): array
    {
        return [
            /* array(
              '!' => array('precedence' => 50, 'class' => 'Twig_Node_Expression_Unary_Not'),
              ),
              array(
              '||' => array('precedence' => 10, 'class' => 'Twig_Node_Expression_Binary_Or', 'associativity' => Twig_ExpressionParser::OPERATOR_LEFT),
              '&&' => array('precedence' => 15, 'class' => 'Twig_Node_Expression_Binary_And', 'associativity' => Twig_ExpressionParser::OPERATOR_LEFT),
              ), */
        ];
    }

    public function getTests(): array
    {
        return [
            //new Twig_SimpleTest('even', 'twig_test_even'),
        ];
    }
}
