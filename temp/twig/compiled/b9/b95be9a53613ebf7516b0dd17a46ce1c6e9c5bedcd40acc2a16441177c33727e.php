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

/* messages.twig */
class __TwigTemplate_2c1215bf3be3e336455b36029f8e5a094b54bdf0a41b7ffaf7410df0cc7731f6 extends \Twig\Template
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
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["messages"] ?? null));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 2
            echo "    ";
            if ((($this->getAttribute($context["message"], "dir", []) != "o") || ($this->getAttribute(($context["contact"] ?? null), "id", []) != $this->getAttribute(($context["user"] ?? null), "id", [])))) {
                // line 3
                echo "        ";
                if ( !twig_test_empty($this->getAttribute($context["message"], "message", []))) {
                    // line 4
                    echo "        <li class=\"chatbox-messages__item ";
                    if (($this->getAttribute($context["message"], "dir", []) == "o")) {
                        echo "user-message";
                    }
                    echo " ";
                    if ($this->getAttribute($context["message"], "is_read_mess", [])) {
                        echo "is_read";
                    }
                    echo " ";
                    if (($this->getAttribute($context["message"], "is_read", []) == "0")) {
                        echo "chatbox-messages__item_new";
                    }
                    echo "\" data-message-id=\"";
                    echo $this->getAttribute($context["message"], "id", []);
                    echo "\" id=\"chb_msg_";
                    echo $this->getAttribute($context["message"], "id", []);
                    echo "\" data-date-added=\"";
                    echo $this->getAttribute($context["message"], "date_added", []);
                    echo "\">
            ";
                    // line 5
                    if (($this->getAttribute($context["loop"], "first", []) != $this->getAttribute($context["loop"], "last", []))) {
                        // line 6
                        echo "                ";
                        if ($this->getAttribute($context["loop"], "first", [])) {
                            // line 7
                            echo "                    ";
                            $context["msg_time"] = twig_date_format_filter($this->env, twig_date_modify_filter($this->env, $this->getAttribute($context["message"], "date_added", []), "+1 hour"), "Y-m-d H:i");
                            // line 8
                            echo "                ";
                        }
                        // line 9
                        echo "                ";
                        if (($this->getAttribute($context["loop"], "first", []) || (($context["msg_time"] ?? null) < twig_date_format_filter($this->env, $this->getAttribute($context["message"], "date_added", []), "Y-m-d H:i")))) {
                            // line 10
                            echo "                    ";
                            $context["msg_time"] = twig_date_format_filter($this->env, twig_date_modify_filter($this->env, $this->getAttribute($context["message"], "date_added", []), "+1 hour"), "Y-m-d H:i");
                            // line 11
                            echo "                    <div
                        class=\"chatbox-messages__time\">";
                            // line 12
                            $module =                             null;
                            $helper =                             'date_format';
                            $name =                             'tpl_date_format';
                            $params = array($this->getAttribute(($context["message"] ?? null), "date_added", [])                            ,$this->getAttribute(($context["date_format_st"] ?? null), "date_time_literal", [])                            ,                            );
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
                            echo "</div>
                ";
                        }
                        // line 14
                        echo "            ";
                    }
                    // line 15
                    echo "            <div
                class=\"";
                    // line 16
                    if (($this->getAttribute(($context["contact"] ?? null), "id", []) != $this->getAttribute(($context["user"] ?? null), "id", []))) {
                        echo "chatbox-messages__userlogo";
                    } else {
                        echo "chatbox-messages__sitelogo";
                    }
                    echo "\">
                ";
                    // line 17
                    if (($this->getAttribute(($context["contact"] ?? null), "id", []) != $this->getAttribute(($context["user"] ?? null), "id", []))) {
                        // line 18
                        echo "                    ";
                        if (($this->getAttribute($context["message"], "dir", []) == "i")) {
                            // line 19
                            echo "                        <img class=\"\" src=\"";
                            echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["contact"] ?? null), "media", []), "user_logo", []), "thumbs", []), "small", []);
                            echo "\" alt=\"";
                            echo $this->getAttribute(($context["contact"] ?? null), "output_name", []);
                            echo "\"/>
                    ";
                        } else {
                            // line 21
                            echo "                        <img class=\"\" src=\"";
                            echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["user"] ?? null), "media", []), "user_logo", []), "thumbs", []), "small", []);
                            echo "\" alt=\"";
                            echo $this->getAttribute(($context["user"] ?? null), "output_name", []);
                            echo "\"/>
                    ";
                        }
                        // line 23
                        echo "                ";
                    } else {
                        // line 24
                        echo "                    ";
                        if (($context["is_mini_logo"] ?? null)) {
                            // line 25
                            echo "                        <img src=\"";
                            echo ($context["site_root"] ?? null);
                            echo $this->getAttribute(($context["mini_logo_settings"] ?? null), "path", []);
                            echo "?";
                            echo twig_random($this->env);
                            echo "\" border=\"0\"
                             alt=\"";
                            // line 26
                            $module =                             null;
                            $helper =                             'seo';
                            $name =                             'seo_tags_default';
                            $params = array("header_text"                            ,                            );
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
                            echo "\"
                             width=\"";
                            // line 27
                            echo $this->getAttribute(($context["mini_logo_settings"] ?? null), "width", []);
                            echo "\"
                             height=\"";
                            // line 28
                            echo $this->getAttribute(($context["mini_logo_settings"] ?? null), "height", []);
                            echo "\" id=\"logo\">
                    ";
                        } else {
                            // line 30
                            echo "                        ";
                            $module =                             null;
                            $helper =                             'start';
                            $name =                             'logo';
                            $params = array(["type" => "user", "settings" => ($context["logo_settings"] ?? null)]                            ,                            );
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
                            // line 31
                            echo "                    ";
                        }
                        // line 32
                        echo "                ";
                    }
                    // line 33
                    echo "            </div>
            <div class=\"chatbox-messages__content\">
                <div
                    class=\"chatbox-messages__bubble ";
                    // line 36
                    if (($this->getAttribute($context["message"], "dir", []) == "o")) {
                        echo "chatbox-messages__bubble-right";
                    } else {
                        echo "chatbox-messages__bubble-left";
                    }
                    echo "\">
                    <div class=\"chatbox-messages__message\">";
                    // line 37
                    echo $this->getAttribute($context["message"], "message", []);
                    echo "</div>
                    ";
                    // line 38
                    if (($this->getAttribute($context["message"], "dir", []) == "o")) {
                        // line 39
                        echo "                        <i data-message-id=\"";
                        echo $this->getAttribute($context["message"], "id", []);
                        echo "\"
                           title=\"";
                        // line 40
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("link_message_delete"                        ,"chatbox"                        ,                        );
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
                        echo "\" data-placement=\"top\"
                           data-toggle=\"tooltip\" class=\"fas fa-times chatbox-messages__delele\"></i>
                        <i class=\"fas fa-check\"></i><i class=\"fas fa-check two\"></i>
                    ";
                    }
                    // line 44
                    echo "                </div>
            </div>
            ";
                    // line 46
                    $context["last_message_dir"] = $this->getAttribute($context["message"], "dir", []);
                    // line 47
                    echo "            ";
                    $context["last_message_time"] = twig_date_format_filter($this->env, $this->getAttribute($context["message"], "date_added", []), "Y-m-d H:i");
                    // line 48
                    echo "        </li>
        ";
                }
                // line 50
                echo "        ";
                if ($this->getAttribute($context["message"], "attaches_count", [])) {
                    // line 51
                    echo "            <li class=\"chatbox-messages__item ";
                    if (($this->getAttribute($context["message"], "dir", []) == "o")) {
                        echo "user-message";
                    }
                    echo " ";
                    if ($this->getAttribute($context["message"], "is_read_mess", [])) {
                        echo "is_read";
                    }
                    echo "\"
                data-message-id=\"";
                    // line 52
                    echo $this->getAttribute($context["message"], "id", []);
                    echo "\" id=\"chb_msg_";
                    echo $this->getAttribute($context["message"], "id", []);
                    echo "\"
                data-date-added=\"";
                    // line 53
                    echo $this->getAttribute($context["message"], "date_added", []);
                    echo "\">
                ";
                    // line 54
                    if ((twig_test_empty(($context["last_message_time"] ?? null)) || (($context["last_message_time"] ?? null) != twig_date_format_filter($this->env, $this->getAttribute($context["message"], "date_added", []), "Y-m-d H:i")))) {
                        // line 55
                        echo "                    <div
                        class=\"chatbox-messages__time\">";
                        // line 56
                        $module =                         null;
                        $helper =                         'date_format';
                        $name =                         'tpl_date_format';
                        $params = array($this->getAttribute(($context["message"] ?? null), "date_added", [])                        ,$this->getAttribute(($context["date_format_st"] ?? null), "date_time_literal", [])                        ,                        );
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
                        echo "</div>
                ";
                    }
                    // line 58
                    echo "                <div
                    class=\"";
                    // line 59
                    if (($this->getAttribute(($context["contact"] ?? null), "id", []) != $this->getAttribute(($context["user"] ?? null), "id", []))) {
                        echo "chatbox-messages__userlogo";
                    } else {
                        echo "chatbox-messages__sitelogo";
                    }
                    echo "\">
                    ";
                    // line 60
                    if (($this->getAttribute(($context["contact"] ?? null), "id", []) != $this->getAttribute(($context["user"] ?? null), "id", []))) {
                        // line 61
                        echo "                        ";
                        if (($this->getAttribute($context["message"], "dir", []) == "i")) {
                            // line 62
                            echo "                            <img class=\"\" src=\"";
                            echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["contact"] ?? null), "media", []), "user_logo", []), "thumbs", []), "small", []);
                            echo "\"
                                 alt=\"";
                            // line 63
                            echo $this->getAttribute(($context["contact"] ?? null), "output_name", []);
                            echo "\"/>
                        ";
                        } else {
                            // line 65
                            echo "                            <img class=\"\" src=\"";
                            echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["user"] ?? null), "media", []), "user_logo", []), "thumbs", []), "small", []);
                            echo "\" alt=\"";
                            echo $this->getAttribute(($context["user"] ?? null), "output_name", []);
                            echo "\"/>
                        ";
                        }
                        // line 67
                        echo "                    ";
                    } else {
                        // line 68
                        echo "                        ";
                        if (($context["is_mini_logo"] ?? null)) {
                            // line 69
                            echo "                            <img src=\"";
                            echo ($context["site_root"] ?? null);
                            echo $this->getAttribute(($context["mini_logo_settings"] ?? null), "path", []);
                            echo "?";
                            echo twig_random($this->env);
                            echo "\" border=\"0\"
                                 alt=\"";
                            // line 70
                            $module =                             null;
                            $helper =                             'seo';
                            $name =                             'seo_tags_default';
                            $params = array("header_text"                            ,                            );
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
                            echo "\"
                                 width=\"";
                            // line 71
                            echo $this->getAttribute(($context["mini_logo_settings"] ?? null), "width", []);
                            echo "\"
                                 height=\"";
                            // line 72
                            echo $this->getAttribute(($context["mini_logo_settings"] ?? null), "height", []);
                            echo "\" id=\"logo\">
                        ";
                        } else {
                            // line 74
                            echo "                            ";
                            $module =                             null;
                            $helper =                             'start';
                            $name =                             'logo';
                            $params = array(["type" => "user", "settings" => ($context["logo_settings"] ?? null)]                            ,                            );
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
                            // line 75
                            echo "                        ";
                        }
                        // line 76
                        echo "                    ";
                    }
                    // line 77
                    echo "                </div>
                <div class=\"chatbox-messages__content\">
                    <div
                        class=\"chatbox-messages__bubble ";
                    // line 80
                    if (($this->getAttribute($context["message"], "dir", []) == "o")) {
                        echo "chatbox-messages__bubble-right";
                    } else {
                        echo "chatbox-messages__bubble-left";
                    }
                    echo "\">
                        ";
                    // line 81
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["message"], "attaches", []));
                    foreach ($context['_seq'] as $context["key"] => $context["attach"]) {
                        // line 82
                        echo "                            ";
                        if (($this->getAttribute($context["attach"], "mime", []) == "image/gif")) {
                            // line 83
                            echo "                                <img class=\"chatbox-messages__message-image pointer\" src=\"";
                            echo $this->getAttribute($this->getAttribute($context["attach"], "format", []), "file_url", []);
                            echo "\"
                                     gallery-src=\"";
                            // line 84
                            echo $this->getAttribute($this->getAttribute($context["attach"], "format", []), "file_url", []);
                            echo "\" style=\"max-width: 200px;\"/>
                            ";
                        } else {
                            // line 86
                            echo "                                <img class=\"chatbox-messages__message-image pointer\"
                                     src=\"";
                            // line 87
                            echo $this->getAttribute($this->getAttribute($this->getAttribute($context["attach"], "format", []), "thumbs", []), "middle", []);
                            echo "\"
                                     gallery-src=\"";
                            // line 88
                            echo $this->getAttribute($this->getAttribute($this->getAttribute($context["attach"], "format", []), "thumbs", []), "grand", []);
                            echo "\"/>
                            ";
                        }
                        // line 90
                        echo "                        ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['key'], $context['attach'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 91
                    echo "                        ";
                    if (($this->getAttribute($context["message"], "dir", []) == "o")) {
                        // line 92
                        echo "                            <i data-message-id=\"";
                        echo $this->getAttribute($context["message"], "id", []);
                        echo "\"
                               title=\"";
                        // line 93
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("link_message_delete"                        ,"chatbox"                        ,                        );
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
                        echo "\" data-placement=\"top\"
                               data-toggle=\"tooltip\" class=\"fas fa-times chatbox-messages__delele\"></i>
                            <i class=\"fas fa-check\"></i><i class=\"fas fa-check two\"></i>
                        ";
                    }
                    // line 97
                    echo "                    </div>
                </div>
                ";
                    // line 99
                    $context["last_message_dir"] = $this->getAttribute($context["message"], "dir", []);
                    // line 100
                    echo "                ";
                    $context["last_message_time"] = twig_date_format_filter($this->env, $this->getAttribute($context["message"], "date_added", []), "Y-m-d H:i");
                    // line 101
                    echo "            </li>
        ";
                }
                // line 103
                echo "
    ";
            }
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "messages.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  546 => 103,  542 => 101,  539 => 100,  537 => 99,  533 => 97,  507 => 93,  502 => 92,  499 => 91,  493 => 90,  488 => 88,  484 => 87,  481 => 86,  476 => 84,  471 => 83,  468 => 82,  464 => 81,  456 => 80,  451 => 77,  448 => 76,  445 => 75,  423 => 74,  418 => 72,  414 => 71,  391 => 70,  383 => 69,  380 => 68,  377 => 67,  369 => 65,  364 => 63,  359 => 62,  356 => 61,  354 => 60,  346 => 59,  343 => 58,  319 => 56,  316 => 55,  314 => 54,  310 => 53,  304 => 52,  293 => 51,  290 => 50,  286 => 48,  283 => 47,  281 => 46,  277 => 44,  251 => 40,  246 => 39,  244 => 38,  240 => 37,  232 => 36,  227 => 33,  224 => 32,  221 => 31,  199 => 30,  194 => 28,  190 => 27,  167 => 26,  159 => 25,  156 => 24,  153 => 23,  145 => 21,  137 => 19,  134 => 18,  132 => 17,  124 => 16,  121 => 15,  118 => 14,  94 => 12,  91 => 11,  88 => 10,  85 => 9,  82 => 8,  79 => 7,  76 => 6,  74 => 5,  53 => 4,  50 => 3,  47 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "messages.twig", "/home/mliadov/public_html/application/modules/chatbox/views/flatty/messages.twig");
    }
}
