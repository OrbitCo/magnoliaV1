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

/* section_albums.twig */
class __TwigTemplate_691324b222fb9ad19cfa1c145e74e2aa1ad4b73f9da9a0c58474ddd07f4d21d9 extends \Twig\Template
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
        echo "<div class=\"albums-list\">
    ";
        // line 2
        $module =         null;
        $helper =         'lang';
        $name =         'ld';
        $params = array("permissions"        ,"media"        ,        );
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
        $context['ld_permissions'] = $result;
        // line 3
        echo "    <div class=\"popup-opt-title\">";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("public_albums"        ,"media"        ,        );
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
    <div id=\"common_albums";
        // line 4
        if ( !($context["is_user_media_owner"] ?? null)) {
            echo "_view";
        }
        echo "\">
        ";
        // line 5
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["media_albums"] ?? null), "common", []));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 6
            echo "            <div class=\"clearfix album album-item ";
            if (( !($context["is_user_media_user"] ?? null) ||  !($context["is_user_media_owner"] ?? null))) {
                echo "disabled";
            }
            // line 7
            echo "                ";
            $module =             null;
            $helper =             'utils';
            $name =             'inArray';
            $params = array($this->getAttribute(($context["item"] ?? null), "id", [])            ,($context["media_in_album"] ?? null)            ,"active"            ,            );
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
            echo "\" id=\"common_album_";
            echo $this->getAttribute($context["item"], "id", []);
            echo "\">
                <div class=\"fleft\">
                    <input type=\"checkbox\" ";
            // line 9
            if (( !($context["is_user_media_user"] ?? null) ||  !($context["is_user_media_owner"] ?? null))) {
                echo "disabled";
            }
            // line 10
            echo "                                           ";
            $module =             null;
            $helper =             'utils';
            $name =             'inArray';
            $params = array($this->getAttribute(($context["item"] ?? null), "id", [])            ,($context["media_in_album"] ?? null)            ,"checked"            ,            );
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
            echo ">
                    <span title=\"";
            // line 11
            echo $this->getAttribute($context["item"], "name", []);
            echo "\">";
            echo $this->getAttribute($context["item"], "name", []);
            echo "</span>
                </div>
                <div class=\"fright\" data-toggle=\"tooltip\"
                title=\"";
            // line 14
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["ld_permissions"] ?? null), "option", []));
            foreach ($context['_seq'] as $context["key_per"] => $context["item_per"]) {
                if (($this->getAttribute($context["item"], "permissions", []) == $context["key_per"])) {
                    echo $context["item_per"];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key_per'], $context['item_per'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            echo "\">
                    <i class=\"fa fa fa-globe\"></i>
                </div>
            </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 19
        echo "    </div>
    ";
        // line 20
        if ($this->getAttribute(($context["user_session_data"] ?? null), "user_id", [])) {
            // line 21
            echo "
    <div id=\"user_title_album\" class=\"popup-opt-title mt20  ";
            // line 22
            if ( !$this->getAttribute(($context["media_albums"] ?? null), "user", [])) {
                echo " hide  ";
            }
            echo "\">";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("my_albums"            ,"media"            ,            );
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
    <div id=\"user_albums\">
        ";
            // line 24
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["media_albums"] ?? null), "user", []));
            foreach ($context['_seq'] as $context["key"] => $context["item"]) {
                // line 25
                echo "            <div class=\"clearfix album album-item ";
                $module =                 null;
                $helper =                 'utils';
                $name =                 'inArray';
                $params = array($this->getAttribute(($context["item"] ?? null), "id", [])                ,($context["media_in_album"] ?? null)                ,"active"                ,                );
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
                echo "\" id=\"user_album_";
                echo $this->getAttribute($context["item"], "id", []);
                echo "\">
                <div class=\"fleft\">
                    <input type=\"checkbox\" ";
                // line 27
                $module =                 null;
                $helper =                 'utils';
                $name =                 'inArray';
                $params = array($this->getAttribute(($context["item"] ?? null), "id", [])                ,($context["media_in_album"] ?? null)                ,"checked"                ,                );
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
                echo ">
                    <span title=\"";
                // line 28
                echo $this->getAttribute($context["item"], "name", []);
                echo "\">";
                echo $this->getAttribute($context["item"], "name", []);
                echo "</span>
                </div>
                <div class=\"fright\" data-toggle=\"tooltip\"
                title=\"";
                // line 31
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["ld_permissions"] ?? null), "option", []));
                foreach ($context['_seq'] as $context["key_per"] => $context["item_per"]) {
                    if (($this->getAttribute($context["item"], "permissions", []) == $context["key_per"])) {
                        echo $context["item_per"];
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['key_per'], $context['item_per'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                echo "\">
                    ";
                // line 32
                if ((($this->getAttribute($context["item"], "permissions", []) == 1) || ($this->getAttribute($context["item"], "permissions", []) == 5))) {
                    // line 33
                    echo "                        <i class=\"fa fa-lock\"></i>
                    ";
                } else {
                    // line 35
                    echo "                        <i class=\"far fa-eye\"></i>
                    ";
                }
                // line 37
                echo "                </div>
            </div>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 40
            echo "    </div>

\t<div class=\"mtb10\">
\t\t<span class=\"pointer link-r-margin btn btn-primary\" id=\"create_album_button\">
            <span class=\"a\">";
            // line 44
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("create_album"            ,"media"            ,            );
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
            echo "</span>
        </span>
\t\t<div class=\"hide mt10\" id=\"create_album_container\">
\t\t\t<span class=\"input-w-btn\">
\t\t\t\t<input type=\"text\" name=\"album_name\" class=\"form-control mb10\" id=\"album_name\">
\t\t\t\t<button id=\"save_album\" class=\"btn btn-default\">
                    ";
            // line 50
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_apply"            ,"start"            ,            );
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
            // line 51
            echo "                </button>
\t\t\t</span>
\t\t</div>
\t</div>
    ";
        }
        // line 56
        echo "</div>

<script type=\"text/javascript\">
\t\$(function(){
        \$('.albums-list [data-toggle=\"tooltip\"]').tooltip();
\t\tloadScripts(
\t\t\t\"";
        // line 62
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("media"        ,"albums.js"        ,"path"        ,        );
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
\t\t\tfunction(){
\t\t\t\talbums_obj = new albums({
                    siteUrl: site_url,
                    permissions: ";
        // line 66
        echo twig_jsonencode_filter(($context["ld_permissions"] ?? null));
        echo ",
                    create_album_success_request: function(){}
                });
\t\t\t},
\t\t\t['albums_obj'],
\t\t\t{async: false}
\t\t);
\t});
</script>
<style>
    .albums-list .tooltip {
        min-width: 100px;
    }
</style>
";
    }

    public function getTemplateName()
    {
        return "section_albums.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  401 => 66,  375 => 62,  367 => 56,  360 => 51,  339 => 50,  311 => 44,  305 => 40,  297 => 37,  293 => 35,  289 => 33,  287 => 32,  274 => 31,  266 => 28,  243 => 27,  216 => 25,  212 => 24,  184 => 22,  181 => 21,  179 => 20,  176 => 19,  156 => 14,  148 => 11,  124 => 10,  120 => 9,  93 => 7,  88 => 6,  84 => 5,  78 => 4,  54 => 3,  33 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "section_albums.twig", "/home/mliadov/public_html/application/modules/media/views/flatty/section_albums.twig");
    }
}
