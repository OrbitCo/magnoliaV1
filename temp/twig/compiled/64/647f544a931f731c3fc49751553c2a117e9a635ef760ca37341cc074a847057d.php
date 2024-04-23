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

/* tree_level.twig */
class __TwigTemplate_f054299a611b4fba66688f199c60566d7894f6e9ff5f90a024e91f4720573f05 extends \Twig\Template
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
        $context['_seq'] = twig_ensure_traversable(($context["list"] ?? null));
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
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 2
            echo "    ";
            $context["id"] = $this->getAttribute($context["item"], "id", []);
            // line 3
            echo "    <li id=\"item_";
            echo ($context["id"] ?? null);
            echo "\" class=\"x_panel\">
      <div class=\"js-page\">
        ";
            // line 5
            if (twig_length_filter($this->env, $this->getAttribute($context["item"], "sub", []))) {
                // line 6
                echo "            <a class=\"collapse-link\">
                <i class=\"fa fa-angle-right\"></i>
            </a>
        ";
            }
            // line 10
            echo "        <div class=\"icons pull-right\">
            <div class=\"btn-group\">
                <span class=\"btn btn-primary\">
                  <a href=\"#\" onclick=\"javascript: activatePage(";
            // line 13
            echo $this->getAttribute($context["item"], "id", []);
            echo ", 0, this);return false;\" id=\"active_";
            echo ($context["id"] ?? null);
            echo "\"
                     class=\"";
            // line 14
            if (($this->getAttribute($context["item"], "status", []) != 1)) {
                echo "hide";
            }
            echo "\" title=\"";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("make_inactive"            ,"start"            ,            );
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
            // line 15
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("make_inactive"            ,"start"            ,            );
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
            // line 16
            echo "                  </a><a href=\"#\" onclick=\"javascript: activatePage(";
            echo $this->getAttribute($context["item"], "id", []);
            echo ", 1, this); return false;\" id=\"deactive_";
            echo ($context["id"] ?? null);
            echo "\"
                     class=\"";
            // line 17
            if (($this->getAttribute($context["item"], "status", []) == 1)) {
                echo "hide";
            }
            echo "\"
                     title=\"";
            // line 18
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("make_active"            ,"start"            ,            );
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
            // line 19
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("make_active"            ,"start"            ,            );
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
            // line 20
            echo "                  </a>
               </span>
                <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\"
                        aria-haspopup=\"true\" aria-expanded=\"false\">
                    <span class=\"caret\"></span>
                    <span class=\"sr-only\">Toggle Dropdown</span>
                </button>
                <ul class=\"dropdown-menu\">
                    <li>
                      <a href=\"#\" onclick=\"javascript: activatePage(";
            // line 29
            echo $this->getAttribute($context["item"], "id", []);
            echo ", 0, this);return false;\" id=\"active_";
            echo ($context["id"] ?? null);
            echo "\"
                         class=\"";
            // line 30
            if (($this->getAttribute($context["item"], "status", []) != 1)) {
                echo "hide";
            }
            echo "\" title=\"";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("make_inactive"            ,"start"            ,            );
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
            // line 31
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_tableicon_is_active"            ,"start"            ,            );
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
            echo "                      </a><a href=\"#\" onclick=\"javascript: activatePage(";
            echo $this->getAttribute($context["item"], "id", []);
            echo ", 1, this); return false;\" id=\"deactive_";
            echo ($context["id"] ?? null);
            echo "\"
                         class=\"";
            // line 33
            if (($this->getAttribute($context["item"], "status", []) == 1)) {
                echo "hide";
            }
            echo "\"
                         title=\"";
            // line 34
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("make_active"            ,"start"            ,            );
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
            // line 35
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_tableicon_is_not_active"            ,"start"            ,            );
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
            // line 36
            echo "                      </a>
                    </li>
                    <li>
                      <a href=\"";
            // line 39
            echo ($context["site_url"] ?? null);
            echo "admin/content/edit/";
            echo $this->getAttribute($context["item"], "lang_id", []);
            echo "/";
            echo $this->getAttribute($context["item"], "id", []);
            echo "\">
                             ";
            // line 40
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("link_create_subitem"            ,"content"            ,            );
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
            echo "</a>
                    </li>
                    <li>
                      <a href=\"";
            // line 43
            echo ($context["site_url"] ?? null);
            echo "admin/content/edit/";
            echo $this->getAttribute($context["item"], "lang_id", []);
            echo "/";
            echo $this->getAttribute($context["item"], "parent_id", []);
            echo "/";
            echo $this->getAttribute($context["item"], "id", []);
            echo "\">
                          ";
            // line 44
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_edit"            ,"start"            ,            );
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
            echo "</a>
                    </li>
                    <li>
                        <a href='#' onclick=\"if (confirm('";
            // line 47
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("note_delete_page"            ,"content"            ,""            ,"js"            ,            );
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
            echo "'))
                           mlSorter.deleteItem(";
            // line 48
            echo $this->getAttribute($context["item"], "id", []);
            echo "); return false;\">
                            ";
            // line 49
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_delete"            ,"start"            ,            );
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
            // line 50
            echo "                        </a>
                    </li>
                </ul>
            </div>
        </div>
        ";
            // line 55
            echo $this->getAttribute($context["item"], "title", []);
            echo "
        <div>
          <span class=\"";
            // line 57
            if (($this->getAttribute($context["item"], "status", []) != 1)) {
                echo "hide";
            }
            echo "\">
            ";
            // line 58
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_tableicon_is_active"            ,"start"            ,            );
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
            // line 59
            echo "          </span><span class=\"";
            if (($this->getAttribute($context["item"], "status", []) == 1)) {
                echo "hide";
            }
            echo "\">
            ";
            // line 60
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_tableicon_is_not_active"            ,"start"            ,            );
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
            echo "          </span>
        </div>
      </div>
      <ul id=\"clsr";
            // line 64
            echo ($context["id"] ?? null);
            echo "ul\" class=\"to_do sort connected x_content hide\" name=\"parent_";
            echo ($context["id"] ?? null);
            echo "\">
        ";
            // line 65
            $this->loadTemplate("tree_level.twig", "tree_level.twig", 65)->display(twig_array_merge($context, ["list" => $this->getAttribute($context["item"], "sub", [])]));
            // line 66
            echo "      </ul>
    </li>
";
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "tree_level.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  503 => 66,  501 => 65,  495 => 64,  490 => 61,  469 => 60,  462 => 59,  441 => 58,  435 => 57,  430 => 55,  423 => 50,  402 => 49,  398 => 48,  375 => 47,  350 => 44,  340 => 43,  315 => 40,  307 => 39,  302 => 36,  281 => 35,  258 => 34,  252 => 33,  245 => 32,  224 => 31,  197 => 30,  191 => 29,  180 => 20,  159 => 19,  136 => 18,  130 => 17,  123 => 16,  102 => 15,  75 => 14,  69 => 13,  64 => 10,  58 => 6,  56 => 5,  50 => 3,  47 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "tree_level.twig", "/home/mliadov/public_html/application/modules/content/views/gentelella/tree_level.twig");
    }
}
