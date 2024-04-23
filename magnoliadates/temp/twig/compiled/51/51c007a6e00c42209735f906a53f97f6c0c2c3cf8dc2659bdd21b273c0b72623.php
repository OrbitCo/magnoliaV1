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

/* ajax_select_gift_form.twig */
class __TwigTemplate_00f119bae4342531b850f794af5c982616010297b3e6e63874065a866ae4ba48 extends \Twig\Template
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
        // line 2
        echo "
";
        // line 3
        if ((($context["type_of_form"] ?? null) == "full")) {
            // line 4
            echo "    <div class=\"content-block load_content\">
        <h1>
            ";
            // line 6
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("user_send_gift"            ,"virtual_gifts"            ,            );
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
            echo ($context["user_name"] ?? null);
            echo "
        </h1>
        <div class=\"modal-body scroll inside select-gift-wrapper\">
            <input id=\"page-num\" type=\"hidden\" value=\"1\">
            ";
            // line 10
            if ((twig_length_filter($this->env, ($context["gifts"] ?? null)) > 0)) {
                // line 11
                echo "                <div class=\"gifts-list-block\">
                    <div class=\"row b-vgifts__list js-gifts-list\">
                        ";
                // line 13
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["gifts"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["gift"]) {
                    // line 14
                    echo "                            <div class=\"col-xs-4 col-sm-3 col-md-3 col-md-2 b-vgifts__item\">
                                <div href=\"";
                    // line 15
                    echo ($context["site_url"] ?? null);
                    echo "virtual_gifts/send_gift/";
                    echo ($context["user_id"] ?? null);
                    echo "/";
                    echo $this->getAttribute($context["gift"], "id", []);
                    echo "\"
                                     class=\"js-gift-choice b-vgifts__thumb b-vgifts__thumb_selectable\" gift-id=\"";
                    // line 16
                    echo $this->getAttribute($context["gift"], "id", []);
                    echo "\">
                                    <img class=\"img-responsive\" src=\"";
                    // line 17
                    echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["gift"], "mediafile", []), "thumbs_data", []), "big", []), "file_url", []);
                    echo "\">
                                </div>
                            </div>
                        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['gift'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 21
                echo "                    </div>
                </div>
                ";
                // line 23
                if (($context["show_more_btn"] ?? null)) {
                    // line 24
                    echo "                    <div class=\"load-more-gifts\">
                        <button class=\"btn btn-primary-inverted\" id=\"load-more-gifts\">
                            ";
                    // line 26
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("user_load_more_gifts"                    ,"virtual_gifts"                    ,                    );
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
                    // line 27
                    echo "                        </button>
                    </div>
                ";
                }
                // line 30
                echo "            ";
            } else {
                // line 31
                echo "                ";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("gifts_empty"                ,"virtual_gifts"                ,                );
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
                // line 32
                echo "            ";
            }
            // line 33
            echo "        </div>
    </div>
";
        } else {
            // line 36
            echo "    <div class=\"content-block load_content\">
        <div class=\"modal-body scroll inside select-gift-wrapper\">
            <input id=\"page-num\" type=\"hidden\" value=\"1\">
            ";
            // line 39
            if ((twig_length_filter($this->env, ($context["gifts"] ?? null)) > 0)) {
                // line 40
                echo "                <div class=\"gifts-list-block\">
                    <div class=\"row b-vgifts__list js-gifts-list\">
                        ";
                // line 42
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["gifts"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["gift"]) {
                    // line 43
                    echo "                            <div class=\"col-xs-4 col-sm-3 col-md-3 col-md-2 b-vgifts__item\">
                                <div href=\"";
                    // line 44
                    echo ($context["site_url"] ?? null);
                    echo "virtual_gifts/send_gift/";
                    echo ($context["user_id"] ?? null);
                    echo "/";
                    echo $this->getAttribute($context["gift"], "id", []);
                    echo "\"
                                     class=\"js-gift-choice b-vgifts__thumb b-vgifts__thumb_selectable\" gift-id=\"";
                    // line 45
                    echo $this->getAttribute($context["gift"], "id", []);
                    echo "\">
                                    <img class=\"img-responsive\" src=\"";
                    // line 46
                    echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["gift"], "mediafile", []), "thumbs_data", []), "big", []), "file_url", []);
                    echo "\">
                                </div>
                            </div>
                        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['gift'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 50
                echo "                    </div>
                </div>
                ";
                // line 52
                if (($context["show_more_btn"] ?? null)) {
                    // line 53
                    echo "                    <div class=\"load-more-gifts\">
                        <button class=\"btn btn-primary-inverted\" id=\"load-more-gifts\">
                            ";
                    // line 55
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("user_load_more_gifts"                    ,"virtual_gifts"                    ,                    );
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
                    // line 56
                    echo "                        </button>
                    </div>
                ";
                }
                // line 59
                echo "            ";
            } else {
                // line 60
                echo "                ";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("gifts_empty"                ,"virtual_gifts"                ,                );
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
                // line 61
                echo "            ";
            }
            // line 62
            echo "        </div>
    </div>
";
        }
        // line 65
        echo "
<script>
    \$(function () {
        loadScripts(
                \"";
        // line 69
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("virtual_gifts"        ,"send_gift.js"        ,"path"        ,        );
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
                function () {
                    virtual_gifts = new SendGift({
                        siteUrl: site_url,
                        use_form: true,
                        btnForm: 'btn-virtual_gift-";
        // line 74
        echo ($context["virtual_gifts_button_rand"] ?? null);
        echo "',
                        urlGetForm: 'virtual_gifts/ajax_get_gifts_form/";
        // line 75
        echo ($context["user_id"] ?? null);
        echo "',
                        urlSendForm: 'virtual_gifts/ajax_set_gifts/";
        // line 76
        echo ($context["user_id"] ?? null);
        echo "',
                        dataType: 'html'
                    });
                },
                ['virtual_gifts'],
                {async: false}
        );

    });
    \$('.js-gifts-list').on('click', '.js-gift-choice', function () {
        var gift_id = \$(this).attr('gift-id');
        \$('button#load-more-gifts').hide();
        \$.ajax({
            url: site_url + \"virtual_gifts/ajax_get_gift_data\",
            method: \"POST\",
            data: {\"id\": gift_id, \"user_id\": \"";
        // line 91
        echo ($context["user_id"] ?? null);
        echo "\"},
            success: function (data) {
                \$('.js-gifts-list').html(data);
            }
        });
    });
    \$('button#load-more-gifts').on('click', function () {
        var page = \$('#page-num').val();
        page = parseInt(page);
        page = page + 1;
        \$.ajax({
            url: site_url + \"virtual_gifts/ajax_get_gifts_form\",
            method: \"POST\",
            data: {\"more_gifts\": \"1\", \"page\": page},
            dataType: 'json',
            success: function (data) {
                var gifts = data.gifts;
                \$('#page-num').val(page);
                for (var key in gifts) {
                    if (gifts[key][\"last\"]) {
                        \$('button#load-more-gifts').hide();
                    }
                    \$('.js-gifts-list').append('<div class=\"col-xs-4 col-sm-3 col-md-3 col-md-2 b-vgifts__item\"><div class=\"js-gift-choice b-vgifts__thumb b-vgifts__thumb_selectable\" gift-id=\"' + gifts[key][\"id\"] + '\"><img class=\"img-responsive\" src=\"' + gifts[key][\"mediafile\"][\"thumbs_data\"][\"big\"][\"file_url\"] + '\"></div></div>');
                }
            }
        });
    });
</script>
";
    }

    public function getTemplateName()
    {
        return "ajax_select_gift_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  339 => 91,  321 => 76,  317 => 75,  313 => 74,  286 => 69,  280 => 65,  275 => 62,  272 => 61,  250 => 60,  247 => 59,  242 => 56,  221 => 55,  217 => 53,  215 => 52,  211 => 50,  201 => 46,  197 => 45,  189 => 44,  186 => 43,  182 => 42,  178 => 40,  176 => 39,  171 => 36,  166 => 33,  163 => 32,  141 => 31,  138 => 30,  133 => 27,  112 => 26,  108 => 24,  106 => 23,  102 => 21,  92 => 17,  88 => 16,  80 => 15,  77 => 14,  73 => 13,  69 => 11,  67 => 10,  39 => 6,  35 => 4,  33 => 3,  30 => 2,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "ajax_select_gift_form.twig", "/home/mliadov/public_html/application/modules/virtual_gifts/views/flatty/ajax_select_gift_form.twig");
    }
}
