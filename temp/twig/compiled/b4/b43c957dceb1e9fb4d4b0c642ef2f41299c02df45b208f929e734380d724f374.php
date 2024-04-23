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

/* helper_user_gifts_block_magazine.twig */
class __TwigTemplate_f27f1ee4dd250aa6783c2e2f0f6d9134b0648dca4d83228180ae584752d98bc1 extends \Twig\Template
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
        if ( !twig_test_empty(($context["gifts"] ?? null))) {
            // line 2
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["gifts"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["gift"]) {
                // line 3
                echo "        <li class=\"fleft\">
            <div class=\"gift-thumb-wall-block\" id=\"gift_thumb-";
                // line 4
                echo $this->getAttribute($context["gift"], "id", []);
                echo "\">
                <img class=\"img-responsive\" src=\"";
                // line 5
                echo $this->getAttribute($context["gift"], "img_thumb", []);
                echo "\" width=\"60\">
            </div>
        </li>
        <div id=\"gift-sender-block-";
                // line 8
                echo $this->getAttribute($context["gift"], "id", []);
                echo "\" class=\"b-vg-info user_gift_info_\">
            ";
                // line 9
                if (( !$this->getAttribute($context["gift"], "is_private", []) || ($context["is_mine"] ?? null))) {
                    // line 10
                    echo "                <div class=\"b-vg-info__top clearfix\">
                    <a class=\"b-vg-info__name\" href=\"";
                    // line 11
                    echo ($context["site_url"] ?? null);
                    echo "users/view/";
                    echo $this->getAttribute($context["gift"], "fk_sender_id", []);
                    echo "/wall\">
                        <div class=\"b-vg-info__photo g-pic-border g-rounded-small\">
                            <img class=\"img-responsive\" src=\"";
                    // line 13
                    echo $this->getAttribute($this->getAttribute($context["gift"], "sender", []), "logo", []);
                    echo "\" style=\"\">
                        </div>
                    </a>
                    <div class=\"b-vg-info__right\">
                        <div><a class=\"b-vg-info__name\" href=\"";
                    // line 17
                    echo ($context["site_url"] ?? null);
                    echo "users/view/";
                    echo $this->getAttribute($context["gift"], "fk_sender_id", []);
                    echo "/wall\">
                                ";
                    // line 18
                    echo $this->getAttribute($this->getAttribute($context["gift"], "sender", []), "name", []);
                    echo "
                            </a></div>
                        <div class=\"b-vg-info__location\">";
                    // line 20
                    echo $this->getAttribute($this->getAttribute($context["gift"], "sender", []), "city", []);
                    echo $this->getAttribute($context["gift"], "is_mine", []);
                    echo "</div>
                    </div>
                </div>

                ";
                    // line 24
                    if ($this->getAttribute($context["gift"], "comment", [])) {
                        // line 25
                        echo "                    <div class=\"b-vg-info__txt\" data-text=\"";
                        echo nl2br(twig_escape_filter($this->env, $this->getAttribute($context["gift"], "comment", []), "html", null, true));
                        echo "\">";
                        echo nl2br(twig_escape_filter($this->env, $this->getAttribute($context["gift"], "comment", []), "html", null, true));
                        echo "</div>
                ";
                    }
                    // line 27
                    echo "            ";
                } else {
                    // line 28
                    echo "                <div class=\"b-vg-info__private\">
                    ";
                    // line 29
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("private_gift"                    ,"virtual_gifts"                    ,                    );
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
                    // line 30
                    echo "                </div>
            ";
                }
                // line 32
                echo "        </div>

        <script type=\"text/javascript\">
        \$(function(){
            \$('.b-vg-info__txt').each(function(i, elem) {
                \$(elem).html(twemoji.parse(unescape(\$(elem).data('text'))));
            });
        });
        \$(function(){
            \$('.user_gift_info_').hide();
            \$('#gift_thumb-";
                // line 42
                echo $this->getAttribute($context["gift"], "id", []);
                echo "').off().on('mouseenter',function(e) {
                \$('div[id*=gift-sender-block-]').hide();
                mouseX = e.clientX;
                mouseY = e.clientY;
                \$('#gift-sender-block-";
                // line 46
                echo $this->getAttribute($context["gift"], "id", []);
                echo "').show().css({
                    'top': mouseY + 15,
                    'left': mouseX + 15
                });
            }).on('mouseleave', function(e){
                var delayHide = setTimeout(function(){\$('#gift-sender-block-";
                // line 51
                echo $this->getAttribute($context["gift"], "id", []);
                echo "').fadeOut()}, 500);
                \$('#gift-sender-block-";
                // line 52
                echo $this->getAttribute($context["gift"], "id", []);
                echo "').hover(function(){clearTimeout(delayHide)}, function(){
                    \$('#gift-sender-block-";
                // line 53
                echo $this->getAttribute($context["gift"], "id", []);
                echo "').delay(200).fadeOut();
                });
            });
        });
        </script>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['gift'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 59
            echo "
    <script>
      \$(function() {
        var all_user_gifts_block = new loadingContent({
          loadBlockWidth: '50%',
          closeBtnClass: 'w',
          scroll: true,
          closeBtnPadding: 5,
          blockBody: true,
          showAfterImagesLoad: false
        });
        \$('#get_all_user_gifts').on('click', function () {
          \$.ajax({
            url: site_url + \"virtual_gifts/ajax_get_user_gifts\",
            method: \"POST\",
            data: {\"user_id\": \"";
            // line 74
            echo ($context["user_id"] ?? null);
            echo "\"},
            success: function (data) {
              all_user_gifts_block.show_load_block(data);
            }
          });
        });
      });
    </script>
";
        }
    }

    public function getTemplateName()
    {
        return "helper_user_gifts_block_magazine.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  197 => 74,  180 => 59,  168 => 53,  164 => 52,  160 => 51,  152 => 46,  145 => 42,  133 => 32,  129 => 30,  108 => 29,  105 => 28,  102 => 27,  94 => 25,  92 => 24,  84 => 20,  79 => 18,  73 => 17,  66 => 13,  59 => 11,  56 => 10,  54 => 9,  50 => 8,  44 => 5,  40 => 4,  37 => 3,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_user_gifts_block_magazine.twig", "/home/mliadov/public_html/application/modules/virtual_gifts/views/flatty/helper_user_gifts_block_magazine.twig");
    }
}
