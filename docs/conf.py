import sys, os
from sphinx.highlighting import lexers
from pygments.lexers.web import PhpLexer


lexers['php'] = PhpLexer(startinline=True)
lexers['php-annotations'] = PhpLexer(startinline=True)
primary_domain = 'php'
highlight_language = 'php'

extensions = []
templates_path = ['_templates']
source_suffix = '.rst'
master_doc = 'index'
project = u'PHP Yousign API client'
copyright = u'Landrok'
version = '1'
html_title = "Yousign API client Documentation"
html_short_title = "Yousign API client"

exclude_patterns = ['_build']
html_static_path = ['_static']

#### sphinx theme
html_theme = 'sphinx_rtd_theme'
html_theme_options = {
    'collapse_navigation': True,
    'display_version': False
}

# Custom sidebar templates, maps document names to template names.
html_sidebars = {
    '**': ['logo-text.html', 'globaltoc.html', 'searchbox.html']
}

# Register the theme as an extension to generate a sitemap.xml
extensions.append("sphinx_rtd_theme")

# Theme options (see theme.conf for more information)
html_theme_options = {

    # Set the path to a special layout to include for the homepage
    # "index_template": "homepage.html",

    # Allow a separate homepage from the master_doc
    # homepage = index

    # Set the name of the project to appear in the nav menu
    # "project_nav_name": "PHP Yousign API client",

    # Set your Disqus short name to enable comments
    # "disqus_comments_shortname": "my_disqus_comments_short_name",

    # Set you GA account ID to enable tracking
    # "google_analytics_account": "my_ga_account",

    # Path to a touch icon
    # "touch_icon": "",

    # Specify a base_url used to generate sitemap.xml links. If not
    # specified, then no sitemap will be built.
    "base_url": "https://yousign-api.readthedocs.io"

    # Allow the "Table of Contents" page to be defined separately from "master_doc"
    # tocpage = Contents

    # Allow the project link to be overriden to a custom URL.
    # projectlink = http://myproject.url
}
