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

/* index.twig */
class __TwigTemplate_33b5d7df8e094c2a245fd4f40c8727da16de478b554238bb919902ac51250a9b extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "index.twig", 1)->display($context);
        // line 2
        $context["rand"] = twig_random($this->env, 9999);
        // line 3
        echo "<div class=\"col-xs-12\">
    <h1>";
        // line 4
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("header_chatbox"        ,"chatbox"        ,        );
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
        echo "</h1>
</div>
<div class=\"col-xs-12\">
    <div class=\"chatbox\" id=\"chatbox\">
        <div class=\"chatbox-users col-xs-12 col-sm-5 col-md-4 col-lg-4\">
            <div class=\"chatbox-users__filter\">
                <input class=\"form-control\" type=\"text\" placeholder=\"";
        // line 10
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("search_placeholder"        ,"chatbox"        ,        );
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
        echo "\" />
                <span class=\"chatbox-users__search-icon\"><i class=\"fas fa-search\"></i></span>
                <span class=\"chatbox-users__add-contact js-add-contact\"><i class=\"fas fa-plus\"></i></span>
            </div>
            <div class=\"chatbox-users__list\">
                <div class=\"chatbox-dialog__empty ";
        // line 15
        if ((twig_length_filter($this->env, ($context["contact_list"] ?? null)) > 1)) {
            echo " hide ";
        }
        echo "\">";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("empty_dialog"        ,"chatbox"        ,        );
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
        echo " <span class=\"chatbox-content__add-contant js-add-contact\">";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("empty_dialog_add_link"        ,"chatbox"        ,        );
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
        echo "</span></div>
                <div class=\"empty\" ";
        // line 16
        if ( !twig_test_empty(($context["contact_list"] ?? null))) {
            echo "style=\"display:none;\"";
        }
        echo ">";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("empty_users"        ,"chatbox"        ,        );
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
                <ul>
                    ";
        // line 18
        $this->loadTemplate("users.twig", "index.twig", 18)->display($context);
        // line 19
        echo "                    ";
        $module =         null;
        $helper =         'banners';
        $name =         'show_banner_place';
        $params = array("banner-320x75"        ,        );
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
        echo "                </ul>
            </div>
        </div>
        <div class=\"chatbox-content col-xs-12 col-sm-7 col-md-8 col-lg-8\">
            <div class=\"chatbox-content__inner\">
                <div class=\"chatbox-dialog\" id=\"chb_dialog\"></div>
                <div class=\"chatbox-dialog__empty\" >";
        // line 26
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("empty_dialog"        ,"chatbox"        ,        );
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
        echo " <span class=\"chatbox-content__add-contant js-add-contact\">";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("empty_dialog_add_link"        ,"chatbox"        ,        );
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
        echo "</span></div>
            </div>
        </div>
        <div class=\"clr\"></div>
    </div>
</div>
<div class=\"col-xs-12\">
    ";
        // line 33
        $module =         null;
        $helper =         'banners';
        $name =         'show_banner_place';
        $params = array("banner-980x90"        ,        );
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
        // line 34
        echo "</div>
<div class=\"clr\"></div>
<script type=\"text/javascript\">
    \$(function() {
      let timerId = setInterval(function () {
        if (\$('.chatbox-users__user').length > 1) {
          \$('.chatbox-users__list .chatbox-dialog__empty').addClass('hide');
        }
        if (\$('.chatbox-users__user').length == 1) {
          \$('.chatbox-users__list .chatbox-dialog__empty').removeClass('hide');
        }
      }, 100);

      window.emojiPicker = new EmojiPicker({
        emojiable_selector: '[data-emojiable=true]',
        assetsPath: '";
        // line 49
        echo ($context["site_root"] ?? null);
        echo "application/js/emoji-picker/img',
        popupButtonClasses: 'far fa-laugh-wink left',
        attachButtonClasses: 'fas fa-paperclip right',
        hasFocus: true,
        onClickAttachBtn: function () {
          //whithout dropdown
          //\$('#chb_attaches').find('.upload-btn input').click();

          \$('#chb_attaches').stop().slideToggle(300, function () {
            if (\$(this).is(':visible')) {
              \$(this).css('display', 'inline-block');
              \$(this).find('.upload-btn input').click();
            }
          });
        },
        emoji_menu_class: 'left',
        iconSize: 20,
        norealTime: false,
        slimScroll: {
          on: true,
          height: '190px',
          railVisible: true,
          alwaysVisible: true,
          size: '5px'
        },
        hideAfterSelect: false
      })
      window.emojiPicker.discover();

      window.chatbox = new Chatbox({
        siteUrl: site_url,
        l_time: '";
        // line 80
        echo ($context["l_time"] ?? null);
        echo "',
        contactId: '";
        // line 81
        echo ($context["contact_id"] ?? null);
        echo "',
        user_id: '";
        // line 82
        echo ($context["user_id"] ?? null);
        echo "',
        image_lng: \"";
        // line 83
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("text_image"        ,"chatbox"        ,        );
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
        btnOk: \"";
        // line 84
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_ok"        ,"start"        ,        );
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
        btnCancel: \"";
        // line 85
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_cancel"        ,"start"        ,        );
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
        langs: {
          text_your: \"";
        // line 87
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("text_your"        ,"chatbox"        ,        );
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
          notice_clear_history: \"";
        // line 88
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("notice_clear_history"        ,"chatbox"        ,        );
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
          notice_delete_message: \"";
        // line 89
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("notice_delete_message"        ,"chatbox"        ,        );
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
        },
        emojiPicker: emojiPicker,
        key_sent_btn : '";
        // line 92
        echo ($context["js_send_btn"] ?? null);
        echo "'
      });

    });
</script>

";
        // line 99
        echo " ";
        $this->loadTemplate("@app/footer.twig", "index.twig", 99)->display($context);
    }

    public function getTemplateName()
    {
        return "index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  484 => 99,  475 => 92,  450 => 89,  427 => 88,  404 => 87,  380 => 85,  357 => 84,  334 => 83,  330 => 82,  326 => 81,  322 => 80,  288 => 49,  271 => 34,  250 => 33,  200 => 26,  192 => 20,  170 => 19,  168 => 18,  140 => 16,  92 => 15,  65 => 10,  37 => 4,  34 => 3,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "index.twig", "/home/mliadov/public_html/application/modules/chatbox/views/flatty/index.twig");
    }
}
