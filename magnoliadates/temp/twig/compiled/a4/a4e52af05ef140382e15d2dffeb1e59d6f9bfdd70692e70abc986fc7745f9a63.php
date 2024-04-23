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

/* ajax_delete_select_block.twig */
class __TwigTemplate_ec6590a05ef6a3ac32f66709211c7761964c0e4774c5e26bae4863dd6532340f extends \Twig\Template
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
        echo "<form name=\"delete_user\" class=\"form-horizontal form-label-right\" id=\"delete_user_form\"
    action=\"";
        // line 2
        echo $this->getAttribute(($context["data"] ?? null), "action", []);
        echo "\" method=\"post\" enctype=\"multipart/form-data\"  >
    <h5 class=\"\" id=\"nickname_list\">
    ";
        // line 4
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["data"] ?? null), "user_names", []));
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
        foreach ($context['_seq'] as $context["_key"] => $context["s"]) {
            // line 5
            echo "        ";
            echo $context["s"];
            if ( !$this->getAttribute($context["loop"], "last", [])) {
                echo ",&nbsp;";
            }
            // line 6
            echo "    ";
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['s'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 7
        echo "    </h5>
    ";
        // line 8
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["data"] ?? null), "user_ids", []));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 9
            echo "        <input type=\"hidden\" name=\"user_ids[]\" value=\"";
            echo twig_escape_filter($this->env, $context["item"]);
            echo "\">
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 11
        echo "    ";
        if ( !$this->getAttribute(($context["data"] ?? null), "deleted", [])) {
            // line 12
            echo "    <div class=\"form-group\">
        <div class=\"col-md-1 col-sm-1 col-xs-1\">
            <input type=\"radio\" class=\"flat\" name=\"action_user\" value=\"block_user\" id=\"block_user\">
        </div>
        <label class=\"col-md-11 col-sm-11 col-xs-11\">";
            // line 16
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("link_deactivate_user"            ,"users"            ,            );
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
            echo "</label>
    </div>
    ";
        }
        // line 19
        echo "    <div class=\"form-group\">
        <div class=\"col-md-1 col-sm-1 col-xs-1\">
            <input type=\"radio\" class=\"flat\" name=\"action_user\" value=\"delete_user\" id=\"delete_user\" ";
        // line 21
        if ($this->getAttribute(($context["data"] ?? null), "deleted", [])) {
            echo "checked";
        }
        echo ">
        </div>
        <label class=\"col-md-11 col-sm-11 col-xs-11\">";
        // line 23
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("delete"        ,"users"        ,        );
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
        echo "</label>
    </div>
    ";
        // line 25
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["callbacks_data"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 26
            echo "    <div class=\"form-group\">
        <div class=\"col-md-1 col-sm-1 col-xs-12\">
            <input
              type=\"checkbox\"
              class=\"flat\"
              name=\"module[]\"
              value=\"";
            // line 32
            echo $this->getAttribute($context["item"], "callback_gid", []);
            echo "\"
              ";
            // line 33
            echo $this->getAttribute($context["item"], "disabled_attr", []);
            echo "
              ";
            // line 34
            if ($this->getAttribute($context["item"], "disabled_attr", [])) {
                echo "checked";
            }
            // line 35
            echo "              ";
            if ( !$this->getAttribute(($context["data"] ?? null), "deleted", [])) {
                echo "disabled";
            }
            echo ">
        </div>
        <label class=\"col-md-11 col-sm-11 col-xs-12\">";
            // line 37
            echo $this->getAttribute($context["item"], "name", []);
            echo "</label>
    </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 40
        echo "</form>

<script type=\"text/javascript\">
    loadScripts(
            \"";
        // line 44
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("users"        ,"admin-users-select.js"        ,"path"        ,        );
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
                    usersSelectedObj = new usersSelected({
                        siteUrl: site_url,
                        isUserDeleted: ";
        // line 48
        echo $this->getAttribute(($context["data"] ?? null), "deleted", []);
        echo "
                    });
            },
            'usersSelectedObj',
            {async: false}
    );
    \$(function() {
        \$('#full_delete').off('click').on('click', function() {
          \$('#delete_user_form').trigger('submit');
        });

        let nickname_list = \$('#nickname_list').text();
        let crop_list = nickname_list;

        if (nickname_list.length >= 100){
            crop_list = nickname_list.substr(0,100)+' ...';
        }

        \$('#nickname_list').text(crop_list);
        \$('#nickname_list').hover(
            function(){\$(this).text(nickname_list);},
            function(){\$(this).text(crop_list);
        });

      \$ ('input[value=\"media_user\"]' ).on('ifChecked', function ( event ) {
        \$('input[value=\"media_gallery\"]').iCheck('check');
        \$('input[value=\"media_gallery\"]').iCheck('disable');
      });
      \$ ('input[value=\"media_user\"]' ).on('ifUnchecked', function ( event ) {
        \$('input[value=\"media_gallery\"]').iCheck('uncheck');
        \$('input[value=\"media_gallery\"]').iCheck('enable');
      });
    });
</script>
";
    }

    public function getTemplateName()
    {
        return "ajax_delete_select_block.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  233 => 48,  207 => 44,  201 => 40,  192 => 37,  184 => 35,  180 => 34,  176 => 33,  172 => 32,  164 => 26,  160 => 25,  136 => 23,  129 => 21,  125 => 19,  100 => 16,  94 => 12,  91 => 11,  82 => 9,  78 => 8,  75 => 7,  61 => 6,  55 => 5,  38 => 4,  33 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "ajax_delete_select_block.twig", "/home/mliadov/public_html/application/modules/users/views/gentelella/ajax_delete_select_block.twig");
    }
}
