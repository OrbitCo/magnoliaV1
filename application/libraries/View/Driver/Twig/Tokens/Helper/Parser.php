<?php

namespace Pg\Libraries\View\Driver\Twig\Tokens\Helper;

use Twig\Error\SyntaxError;
use Twig\Token;

class Parser extends \Twig_TokenParser
{
    private $params = [];

    /**
     * @param Token $token
     *
     * @throws SyntaxError
     *
     * @return Node
     */
    public function parse(Token $token): Node
    {
        $var = null;
        $module = null;

        $this->params = [];

        $stream = $this->parser->getStream();

        if ($stream->nextIf(Token::PUNCTUATION_TYPE, '{')) {
            $helper = $this->parser->getExpressionParser()->parseExpression();
            $stream->expect(Token::PUNCTUATION_TYPE, '}');
        } else {
            $helper = $stream->expect(Token::NAME_TYPE)->getValue();
            if ($stream->nextIf(Token::OPERATOR_TYPE, '=')) {
                $var = $helper;
                $helper = $stream->expect(Token::NAME_TYPE)->getValue();
            }
        }

        if ($stream->nextIf(Token::PUNCTUATION_TYPE, ':')) {
            $module = $helper;
            $helper = $stream->expect(Token::NAME_TYPE)->getValue();
        }

        $stream->expect(Token::PUNCTUATION_TYPE, '.');

        if ($stream->nextIf(Token::PUNCTUATION_TYPE, '{')) {
            $function = $this->parser->getExpressionParser()->parseExpression();
            $stream->expect(Token::PUNCTUATION_TYPE, '}');
        } else {
            $function = $stream->expect(Token::NAME_TYPE)->getValue();
        }

        $stream->expect(Token::PUNCTUATION_TYPE, '(');
        $this->parseParams();
        $stream->expect(Token::BLOCK_END_TYPE);

        return new Node($module, $helper, $function, $this->params, $var, $token->getLine(), $this->getTag());
    }

    /**
     * @param $helper
     * @param $function
     * @param null $params
     *
     * @return false|mixed|string
     */
    private function getHelper($helper, $function, $params = null)
    {
        $ci = get_instance();
        $ci->load->helper($helper);
        if (function_exists($function)) {
            return call_user_func_array($function, $params);
        }

        return '';
    }

    /**
     * @param $helper
     * @param $function
     * @param null $params
     *
     * @return string
     */
    private function callHelper($helper, $function, $params = null): string
    {
        $ci = get_instance();
        $ci->load->helper($helper);
        if (function_exists($function)) {
            ob_start();
            $result = call_user_func_array($function, $params);
            $output_buffer = ob_get_contents();
            ob_end_clean();

            return $output_buffer . $result;
        }

        return '';
    }

    /**
     * @throws SyntaxError
     */
    private function parseParams()
    {
        $stream = $this->parser->getStream();

        if ($stream->nextIf(Token::PUNCTUATION_TYPE, ')')) {
            return false;
        } elseif (is_null($this->params)) {
            $this->params = [];
        }

        $params_expr = $this->parser->getExpressionParser()->parseExpression();

        $this->params[] = $params_expr;

        if ($stream->nextIf(Token::PUNCTUATION_TYPE, ',')) {
            $this->parseParams($stream);
        } else {
            $stream->expect(Token::PUNCTUATION_TYPE, ')');

            return true;
        }
    }

    /**
     * @return string
     */
    public function getTag(): string
    {
        return 'helper';
    }
}
