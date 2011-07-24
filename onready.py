#!/usr/bin/python
# coding=utf-8

# Dimitrios Kouzis-Loukas (dkouzisloukas@scalingexcellence.co.uk)
# (c) 2011 Scaling Excellence
# For support and tutorials: http://scalingexcellence.co.uk/onready/

# onready extracts all the javascript from smarty template files
# and creates appropriate methods
# e.g. onready templates
#
# function indextpl() {
#     console.log("hello world");
# }

import re, os, sys, fnmatch

def scan(root):
    gxm = ""
    for path, dirs, files in os.walk(root):
        for filename in fnmatch.filter(files, "*.tpl"):
            fname = os.path.join(path, filename)
            g = open(fname, 'r').read()
            
            gxm += "function %s() {\n    %s\n}\n" % (
                re.sub('[^a-zA-Z0-9]','',fname.replace(root,"")),
                "\n".join(
                    re.findall('{onready}(.*?){/onready}',g, re.S)
                )
                .replace("{literal}","")
                .replace("{/literal}","")
                .replace("\n","\n    ").strip()
            )
    return gxm

if __name__ == '__main__':
    if (len(sys.argv)>=2):
        print scan(sys.argv[1])
    else:
        print scan(os.curdir)
