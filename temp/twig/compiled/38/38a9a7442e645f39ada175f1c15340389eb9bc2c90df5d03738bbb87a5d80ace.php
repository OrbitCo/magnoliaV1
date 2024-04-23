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

/* users.twig */
class __TwigTemplate_28b06a191bc7e556001f1a0b6908c97a4f844d753964eabe144f8cc9cb4c6f82 extends \Twig\Template
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
        $context['_seq'] = twig_ensure_traversable(($context["contact_list"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["dialog"]) {
            // line 2
            echo "    <li class=\"chatbox-users__user\" data-contact-id=\"";
            echo $this->getAttribute($this->getAttribute($context["dialog"], "contact", []), "id", []);
            echo "\" id=\"chb_user_";
            echo $this->getAttribute($this->getAttribute($context["dialog"], "contact", []), "id", []);
            echo "\" data-udate=\"";
            echo $this->getAttribute($context["dialog"], "date_update", []);
            echo "\" data-id=\"";
            echo $this->getAttribute($context["dialog"], "id", []);
            echo "\">
        <div class=\"chatbox-users__photo ";
            // line 3
            if (($this->getAttribute($this->getAttribute($context["dialog"], "contact", []), "id", []) == ($context["user_id"] ?? null))) {
                echo "sitelogo";
            }
            echo "\">
            ";
            // line 4
            if (($this->getAttribute($this->getAttribute($context["dialog"], "contact", []), "id", []) == ($context["user_id"] ?? null))) {
                // line 5
                echo "            <img src=\"";
                echo ($context["site_root"] ?? null);
                echo $this->getAttribute(($context["mini_logo_settings"] ?? null), "path", []);
                echo "?";
                echo twig_random($this->env);
                echo "\" border=\"0\"
                alt=\"";
                // line 6
                $module =                 null;
                $helper =                 'seo';
                $name =                 'seo_tags_default';
                $params = array("header_text"                ,                );
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
                // line 7
                echo $this->getAttribute(($context["mini_logo_settings"] ?? null), "width", []);
                echo "\"
                height=\"";
                // line 8
                echo $this->getAttribute(($context["mini_logo_settings"] ?? null), "height", []);
                echo "\" id=\"logo\">
            ";
            } else {
                // line 10
                echo "            <img src=\"";
                echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["dialog"], "contact", []), "media", []), "user_logo", []), "thumbs", []), "small", []);
                echo "\" />
            ";
            }
            // line 12
            echo "        </div>
        <div class=\"chatbox-users__content\">
            <div class=\"chatbox-users__cinner\">
                <span class=\"chatbox-users__date\">";
            // line 15
            $module =             null;
            $helper =             'date_format';
            $name =             'tpl_date_format';
            $params = array($this->getAttribute($this->getAttribute(($context["dialog"] ?? null), "last_message", []), "date_added", [])            ,$this->getAttribute(($context["date_format_st"] ?? null), "date_time_literal", [])            ,            );
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
                <div class=\"chatbox-users__new_msg\" title=\"";
            // line 16
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("new_messages"            ,"chatbox"            ,            );
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
            echo "\" data-placement=\"left\" data-toggle=\"tooltip\">";
            if (($this->getAttribute($context["dialog"], "count_new", []) > 0)) {
                echo "<span>";
                echo $this->getAttribute($context["dialog"], "count_new", []);
                echo "</span>";
            }
            echo "</div>
                <div class=\"chatbox-users__username\">
                    ";
            // line 18
            if (($this->getAttribute($this->getAttribute($context["dialog"], "contact", []), "id", []) != ($context["user_id"] ?? null))) {
                // line 19
                echo "                        ";
                if ($this->getAttribute($this->getAttribute($context["dialog"], "contact", []), "online_status", [])) {
                    echo "<span class=\"chatbox-users__online\"></span>";
                }
                // line 20
                echo "                        ";
                echo $this->getAttribute($this->getAttribute($context["dialog"], "contact", []), "output_name", []);
                echo "
                    ";
            } else {
                // line 22
                echo "                        ♡ ";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("site_notification"                ,"chatbox"                ,                );
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
                // line 23
                echo "                    ";
            }
            // line 24
            echo "                </div>
                <div class=\"chatbox-users__message ";
            // line 25
            if (((($this->getAttribute($this->getAttribute($context["dialog"], "last_message", []), "dir", []) == "o") && ($this->getAttribute($this->getAttribute($context["dialog"], "contact", []), "id", []) != ($context["user_id"] ?? null))) && $this->getAttribute($this->getAttribute($context["dialog"], "last_message", []), "is_read_mess", []))) {
                echo " is_read ";
            }
            echo "\">
                    ";
            // line 26
            if ((($this->getAttribute($this->getAttribute($context["dialog"], "last_message", []), "dir", []) == "o") && ($this->getAttribute($this->getAttribute($context["dialog"], "contact", []), "id", []) != ($context["user_id"] ?? null)))) {
                echo "<span class=\"chatbox-users__your\">";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("text_your"                ,"chatbox"                ,                );
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
                echo ": </span>";
            }
            // line 27
            echo "                    ";
            echo $this->getAttribute($this->getAttribute($context["dialog"], "last_message", []), "message", []);
            echo "
                    ";
            // line 28
            if ((($this->getAttribute($this->getAttribute($context["dialog"], "last_message", []), "dir", []) == "o") && ($this->getAttribute($this->getAttribute($context["dialog"], "contact", []), "id", []) != ($context["user_id"] ?? null)))) {
                // line 29
                echo "                        <i class=\"fas fa-check\"></i><i class=\"fas fa-check two\"></i>
                    ";
            }
            // line 31
            echo "                </div>
                <i data-contact-id=\"";
            // line 32
            echo $this->getAttribute($context["dialog"], "contact_id", []);
            echo "\" title=\"";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("link_delete_dialog"            ,"chatbox"            ,            );
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
            echo "\" class=\"fas fa-times chatbox-users__delele\" data-placement=\"left\" data-toggle=\"tooltip\"></i>
            </div>
        </div>
    </li>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['dialog'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 37
        echo "
<script type=\"text/javascript\">
    \$(function(){
        \$('.chatbox [data-toggle=\"tooltip\"]').tooltip();
    });
</script>
";
    }

    public function getTemplateName()
    {
        return "users.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  275 => 37,  243 => 32,  240 => 31,  236 => 29,  234 => 28,  229 => 27,  204 => 26,  198 => 25,  195 => 24,  192 => 23,  170 => 22,  164 => 20,  159 => 19,  157 => 18,  127 => 16,  104 => 15,  99 => 12,  93 => 10,  88 => 8,  84 => 7,  61 => 6,  53 => 5,  51 => 4,  45 => 3,  34 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "users.twig", "/home/mliadov/public_html/application/modules/chatbox/views/flatty/users.twig");
    }
}
