<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* helper_receipt_gifts_menu.twig */
class __TwigTemplate_87c8375258f7491272ceed8c46748b5f98bc15b40cfa81baf0bf2765805ed853 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<div class=\"menu-alerts-more-items\" id=\"receipt_gifts_list_";
        echo ($context["rand"] ?? null);
        echo "\" >
    ";
        // line 2
        if ( !twig_test_empty(($context["gifts"] ?? null))) {
            // line 3
            echo "        ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["gifts"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["gift"]) {
                echo "        
        <li class=\"menu-alerts-more-item clearfix\">            
            <span class=\"hide summand\">1</span>     
            <a href=\"javascript:void(0);\" gift-id=\"";
                // line 6
                echo $this->getAttribute($context["gift"], "id", []);
                echo "\" class=\"receipt-gift\">
                <div class=\"message-image\">
                    <img src=\"";
                // line 8
                echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["gift"], "sender_media", []), "user_logo", []), "thumbs", []), "small", []);
                echo "\" alt=\"";
                echo $this->getAttribute($context["gift"], "sender_name", []);
                echo "\">
                </div>
                <div class=\"message-body\">
                    <div class=\"text\">";
                // line 11
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("gift_receipt_from_user"                ,"virtual_gifts"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                } elseif (function_exists($name)) {
                $result = call_user_func_array($name, $params);
                } else {
                $result = '';
                }
                $output_buffer = @ob_get_contents();
                @ob_end_clean();
                echo $output_buffer.$result;
                echo " ";
                echo $this->getAttribute($context["gift"], "sender_name", []);
                echo "</div>
                </div>
            </a>
        </li>        
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['gift'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 16
            echo "    ";
        }
        // line 17
        echo "</div>
<script>
    \$(function(){

            loadScripts(
                    \"";
        // line 22
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("virtual_gifts"        ,"receipt_gifts.js"        ,"path"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        echo "\",
                    function(){
                            receipt_gifts = new ReceiptGift({
                                    siteUrl: site_url,
                                    use_form: true,
                                    btnForm: 'receipt-gift',
                                    urlGetForm: 'virtual_gifts/ajax_get_receipt_gift',
                                    urlSendForm: 'virtual_gifts/ajax_set_gifts/";
        // line 29
        echo ($context["user_id"] ?? null);
        echo "',
                                    dataType: 'html',
                                    giftsListId: 'receipt_gifts_list_";
        // line 31
        echo ($context["rand"] ?? null);
        echo "'
                            });
                    },
                    ['virtual_gifts','receipt_gifts'],
                    {async: false}
            );
            ";
        // line 37
        if ((($context["gift_opened"] ?? null) == false)) {
            // line 38
            echo "                var gift_id = \$('.receipt-gift:first').attr('gift-id');
                if(receipt_gifts.properties.use_form && typeof(gift_id) !== 'undefined'){
                    receipt_gifts.get_form(gift_id);
                }
            ";
        }
        // line 43
        echo "
    });
</script>";
    }

    public function getTemplateName()
    {
        return "helper_receipt_gifts_menu.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  153 => 43,  146 => 38,  144 => 37,  135 => 31,  130 => 29,  101 => 22,  94 => 17,  91 => 16,  59 => 11,  51 => 8,  46 => 6,  37 => 3,  35 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_receipt_gifts_menu.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\virtual_gifts\\views\\flatty\\helper_receipt_gifts_menu.twig");
    }
}
