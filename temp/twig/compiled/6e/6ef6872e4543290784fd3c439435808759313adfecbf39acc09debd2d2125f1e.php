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

/* list_kisses.twig */
class __TwigTemplate_2ad86ca3d4308a47d3ae174f81d9711498e5f5349fe5941cf5f42e01dbeb7173 extends \Twig\Template
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
        echo "<div class=\"content-block load_content\">
    <h1>
        ";
        // line 3
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("kisses_form_title"        ,"kisses"        ,        );
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
        // line 4
        echo "    </h1>
    <div class=\"modal-body scroll inside\">
        <div class=\"row\">
            ";
        // line 7
        if ((twig_length_filter($this->env, ($context["kisses"] ?? null)) > 0)) {
            // line 8
            echo "                <form id=\"kisses_form\" action=\"\" method=\"post\" role=\"form\">
                    <div>
                        ";
            // line 10
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("kisses_annotation"            ,"kisses"            ,            );
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
            // line 11
            echo "                    </div>
                    <div class=\"scroll_f_kiss\">
                        <ul class=\"list-inline\">
                            ";
            // line 14
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["kisses"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["kiss"]) {
                // line 15
                echo "                                <li>
                                    <label for=\"kiss-";
                // line 16
                echo $this->getAttribute($context["kiss"], "id", []);
                echo "\">
                                        <input type=\"radio\" value=\"";
                // line 17
                echo $this->getAttribute($context["kiss"], "id", []);
                echo "\" id=\"kiss-";
                echo $this->getAttribute($context["kiss"], "id", []);
                echo "\" name=\"kiss\" />
                                        <img src=\"";
                // line 18
                echo ($context["file_url"] ?? null);
                echo twig_escape_filter($this->env, $this->getAttribute($context["kiss"], "image", []));
                echo "\" alt=\"";
                echo $this->getAttribute($context["kiss"], "id", []);
                echo "\" />
                                    </label>
                                </li>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['kiss'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 22
            echo "                        </ul>
                    </div>
                    <div class=\"message-kiss\">
                        <div>
                            ";
            // line 26
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("message"            ,"kisses"            ,            );
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
            echo "                        </div>
                        <div class=\"form-group\">
                            <textarea name=\"message\" id=\"message\" maxlength=\"";
            // line 29
            echo ($context["maxlength"] ?? null);
            echo "\"
                                      row=\"5\" cols=\"50\" class=\"form-control\"></textarea>
                        </div>
                    </div>
                    <input type=\"hidden\" value=\"";
            // line 33
            echo ($context["object_id"] ?? null);
            echo "\" name=\"object_id\">
                    <input type=\"button\" name=\"btn_send\" id=\"btn_send_kisses\" class=\"btn btn-primary\"
                           value=\"";
            // line 35
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("kiss"            ,"kisses"            ,""            ,"button"            ,            );
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
                    <div id=\"symbols\" class=\"fright\">";
            // line 36
            echo ($context["maxlength"] ?? null);
            echo "</div>
                </form>
            ";
        } else {
            // line 39
            echo "                ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("no_kisses"            ,"kisses"            ,            );
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
            // line 40
            echo "            ";
        }
        // line 41
        echo "        </div>
    </div>
</div>
<script>
    // loadScripts(
    //         \"";
        // line 46
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array(""        ,"jquery-slimscroll.js"        ,"path"        ,        );
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
    //         function () {},
    //         '',
    //         {async: false}
    // );
    \$(function () {
        \$('#kisses_form li').on(\"click\", function () {
            \$(\"#kisses_form li\").removeClass(\"selected\");
            \$(this).addClass(\"selected\");
        });

        \$('label img').off('click').on('click', function () {
            \$(\"#\" + \$(this).parents(\"label\").attr(\"for\")).click();
        });

        var maxLength = \$('#message').attr('maxlength');
        \$('#message').keyup(function () {
            var curLength = \$('#message').val().length;
            \$(this).val(\$(this).val().substr(0, maxLength));

            var remaning = maxLength - curLength;

            if (remaning < 0) {
                remaning = 0;
            }

            \$('#symbols').html(remaning);

            if (remaning < 10) {
                \$('#symbols').addClass('warning');
            } else {
                \$('#symbols').removeClass('warning');
            }
        });
        // \$('.scroll_f_kiss').slimScroll({
        //     height: '100px',
        //     railVisible: true,
        //     alwaysVisible: true
        // });

    });
</script>
";
    }

    public function getTemplateName()
    {
        return "list_kisses.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  226 => 46,  219 => 41,  216 => 40,  194 => 39,  188 => 36,  165 => 35,  160 => 33,  153 => 29,  149 => 27,  128 => 26,  122 => 22,  109 => 18,  103 => 17,  99 => 16,  96 => 15,  92 => 14,  87 => 11,  66 => 10,  62 => 8,  60 => 7,  55 => 4,  34 => 3,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "list_kisses.twig", "/home/mliadov/public_html/application/modules/kisses/views/flatty/list_kisses.twig");
    }
}
