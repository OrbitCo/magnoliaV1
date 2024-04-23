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

/* tracker_block.twig */
class __TwigTemplate_f5935e18ce7e899bf842e609474e577b4a5f287a1a69f9c1fea230ef57aa9590 extends \Twig\Template
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
        if (($context["ga_default_account_id"] ?? null)) {
            // line 2
            echo "    <script async src=\"https://www.googletagmanager.com/gtag/js?id=";
            echo ($context["ga_default_account_id"] ?? null);
            echo "\"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '";
            // line 8
            echo ($context["ga_default_account_id"] ?? null);
            echo "');
    </script>
    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

        ga('create', '";
            // line 23
            echo ($context["ga_default_account_id"] ?? null);
            echo "', 'auto', {'allowLinker': true});

        ga('require', 'displayfeatures');
        ga('require', 'linker');
        ga('linker:autoLink', ['payproglobal.com', 'datingsoftware.ru', 'demo.datingpro.com', 'dpdynamicpages.tilda.ws', 'datingpro.tilda.ws']);
        ga('require', 'GTM-P8PCWKG');

        ga(function (tracker) {
            var clientId = tracker.get('clientId') // получаем clientId из Google Analytics
            document.cookie = \"_ga_cid=\" + clientId + \"; path=/\"; // сохраняем cookie в _ga_cid
            ga('set', 'dimension3', clientId); // записываем clientId пользователя в параметр
        });

        ga('send', 'pageview');
        ";
            // line 37
            if ($this->getAttribute(($context["user_session_data"] ?? null), "user_id", [])) {
                // line 38
                echo "            ga('set', 'userId', ";
                echo $this->getAttribute(($context["user_session_data"] ?? null), "user_id", []);
                echo ");
        ";
            }
            // line 40
            echo "    </script>
";
        }
        // line 42
        echo "
";
        // line 43
        if (($context["tracker_code"] ?? null)) {
            // line 44
            echo "    ";
            echo ($context["tracker_code"] ?? null);
            echo "
";
        }
    }

    public function getTemplateName()
    {
        return "tracker_block.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  94 => 44,  92 => 43,  89 => 42,  85 => 40,  79 => 38,  77 => 37,  60 => 23,  42 => 8,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "tracker_block.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\seo_advanced\\views\\flatty\\tracker_block.twig");
    }
}
