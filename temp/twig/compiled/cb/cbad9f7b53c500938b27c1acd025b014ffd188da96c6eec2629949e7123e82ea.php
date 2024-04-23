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

/* add_new_contact_users_block.twig */
class __TwigTemplate_8b909affeb0b40056a05787265375a606ac6398acac0f2628c4d71f2bafc356e extends \Twig\Template
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
        $module =         null;
        $helper =         'users';
        $name =         're_format_users';
        $params = array(["users" => ($context["users"] ?? null), "return" => true]        ,        );
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
        $context['users'] = $result;
        // line 2
        if (($context["users"] ?? null)) {
            // line 3
            echo "    ";
            if ( !twig_test_empty(($context["sort_data"] ?? null))) {
                // line 4
                echo "        <div class=\"sorter-block clearfix\" id=\"sorter_block\">
            <div class=\"col-xs-7 col-sm-7 col-md-7 col-lg-7\">
                ";
                // line 6
                $module =                 null;
                $helper =                 'start';
                $name =                 'sorter';
                $params = array(["links" => $this->getAttribute(                // line 7
($context["sort_data"] ?? null), "links", []), "order" => $this->getAttribute(                // line 8
($context["sort_data"] ?? null), "order", []), "direction" => $this->getAttribute(                // line 9
($context["sort_data"] ?? null), "direction", []), "url" => $this->getAttribute(                // line 10
($context["sort_data"] ?? null), "url", [])]                ,                );
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
                // line 12
                echo "            </div>
            <div class=\"col-xs-5 col-sm-5 col-md-5\">
                <div class=\"fright lh30 search-top-pager\">
                    ";
                // line 15
                $context["page_data"] = twig_array_merge(($context["page_data"] ?? null), ["type" => "cute"]);
                // line 16
                echo "                    ";
                $module =                 null;
                $helper =                 'start';
                $name =                 'pagination';
                $params = array(($context["page_data"] ?? null)                ,                );
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
                // line 17
                echo "                </div>
            </div>
        </div>
    ";
            }
        } else {
            // line 22
            echo "    <h2 class=\"text-center p10\">
        ";
            // line 23
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("header_users_found"            ,"users"            ,            );
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
            echo ": ";
            echo $this->getAttribute(($context["page_data"] ?? null), "total_rows", []);
            echo "
    </h2>
";
        }
        // line 26
        echo "
<div class=\"user-list clearfix\">
    ";
        // line 28
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["users"] ?? null));
        foreach ($context['_seq'] as $context["ukey"] => $context["user"]) {
            // line 29
            echo "        ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("text_user_logo"            ,"users"            ,""            ,"button"            ,($context["user"] ?? null)            ,            );
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
            $context['text_user_logo'] = $result;
            // line 30
            echo "        <div id=\"item-block-";
            echo $this->getAttribute($context["user"], "id", []);
            echo "\"
            class=\"user-list-item clearfix ";
            // line 31
            if ((($this->getAttribute($context["user"], "is_highlight_in_search", []) || $this->getAttribute(            // line 32
$context["user"], "leader_bid", [])) || ($this->getAttribute(            // line 33
$context["user"], "is_up_in_search", []) && $this->getAttribute(($context["page_data"] ?? null), "use_leader", [])))) {
                echo "highlight";
            }
            echo "\">
            ";
            // line 34
            if ($this->getAttribute($context["user"], "leader_bid", [])) {
                // line 35
                echo "                <div class=\"lift_up\">
                    ";
                // line 36
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("header_leader"                ,"users"                ,                );
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
                // line 37
                echo "                </div>
            ";
            }
            // line 39
            echo "
            <div class=\"\">
                <div class=\"image\">
                    <a href=\"";
            // line 42
            $module =             null;
            $helper =             'seo';
            $name =             'seolink';
            $params = array("users"            ,"view"            ,($context["user"] ?? null)            ,            );
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
            echo "\">
                        <img src=\"";
            // line 43
            echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["user"], "media", []), "user_logo", []), "thumbs", []), "small", []);
            echo "\" class=\"img-rounded\" alt=\"";
            echo ($context["text_user_logo"] ?? null);
            echo "\" title=\"";
            echo ($context["text_user_logo"] ?? null);
            echo "\">
                    </a>
                </div>
                <div class=\"descr-1\">
                    <div class=\"\" style=\"float:left\">
                        <div class=\"\">
                            <a href=\"";
            // line 49
            $module =             null;
            $helper =             'seo';
            $name =             'seolink';
            $params = array("users"            ,"view"            ,($context["user"] ?? null)            ,            );
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
            echo "\">
                                ";
            // line 50
            echo $this->getAttribute($context["user"], "output_name", []);
            echo "
                            </a>, ";
            // line 51
            echo $this->getAttribute($context["user"], "age", []);
            echo "
                        </div>
                        ";
            // line 53
            if ($this->getAttribute($context["user"], "location", [])) {
                // line 54
                echo "                            <div class=\"\">
                                <i class=\"fas fa-map-marker-alt g\"></i>
                                <span>";
                // line 56
                echo $this->getAttribute($context["user"], "location", []);
                echo "</span>
                            </div>
                        ";
            }
            // line 59
            echo "
                        ";
            // line 60
            if (($context["pm_installed"] ?? null)) {
                // line 61
                echo "                            <div class=\"\">
                                <span>
                                    ";
                // line 63
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("field_looking_user_type"                ,"users"                ,                );
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
                // line 64
                echo "                                    ";
                echo $this->getAttribute($context["user"], "looking_user_type_str", []);
                echo ", ";
                echo $this->getAttribute($context["user"], "age_min", []);
                echo "-";
                echo $this->getAttribute($context["user"], "age_max", []);
                echo "
                                </span>
                            </div>
                        ";
            }
            // line 68
            echo "                    </div>
                    <div class=\"text-right\">
                        <input type=\"button\" value=\"";
            // line 70
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("button_start_dialog"            ,"chatbox"            ,            );
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
            echo "\" data-user-id=\"";
            echo $this->getAttribute($context["user"], "id", []);
            echo "\" class=\"btn btn-primary chatbox-start-dialog-btn\">
                    </div>
                </div>
            </div>
        </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['ukey'], $context['user'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 76
        echo "</div>

";
        // line 78
        if (($context["users"] ?? null)) {
            // line 79
            echo "    <div id=\"pages_block_2\" class=\"tac\">
        ";
            // line 80
            $context["page_data"] = twig_array_merge(($context["page_data"] ?? null), ["type" => "full"]);
            // line 81
            echo "        ";
            $module =             null;
            $helper =             'start';
            $name =             'pagination';
            $params = array(($context["page_data"] ?? null)            ,            );
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
            // line 82
            echo "    </div>
";
        }
        // line 84
        echo "<script>
    \$(function () {
      new usersList({
        siteUrl: \"";
        // line 87
        echo ($context["site_url"] ?? null);
        echo "\",
        viewUrl: \"";
        // line 88
        $module =         null;
        $helper =         'seo';
        $name =         'seolink';
        $params = array("users"        ,""        ,        );
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
        viewAjaxUrl: \"";
        // line 89
        echo ($context["site_url"] ?? null);
        echo "chatbox/ajax_search_users/\",
        listBlockId: 'main_users_results',
        tIds: ['pages_block_1', 'pages_block_2', 'sorter_block']
      });

      \$('.chatbox-start-dialog-btn').off('click').click(function() {
        if (typeof window.chatbox != 'undefined') {
          window.chatbox.startDialog(\$(this).data('user-id'), true);
        }
        return false;
      });
    });
</script>
";
    }

    public function getTemplateName()
    {
        return "add_new_contact_users_block.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  457 => 89,  434 => 88,  430 => 87,  425 => 84,  421 => 82,  399 => 81,  397 => 80,  394 => 79,  392 => 78,  388 => 76,  355 => 70,  351 => 68,  339 => 64,  318 => 63,  314 => 61,  312 => 60,  309 => 59,  303 => 56,  299 => 54,  297 => 53,  292 => 51,  288 => 50,  265 => 49,  252 => 43,  229 => 42,  224 => 39,  220 => 37,  199 => 36,  196 => 35,  194 => 34,  188 => 33,  187 => 32,  186 => 31,  181 => 30,  159 => 29,  155 => 28,  151 => 26,  124 => 23,  121 => 22,  114 => 17,  92 => 16,  90 => 15,  85 => 12,  67 => 10,  66 => 9,  65 => 8,  64 => 7,  60 => 6,  56 => 4,  53 => 3,  51 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "add_new_contact_users_block.twig", "/home/mliadov/public_html/application/modules/chatbox/views/flatty/add_new_contact_users_block.twig");
    }
}
