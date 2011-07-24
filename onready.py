#!/usr/bin/python
# coding=utf-8

# Dimitrios Kouzis-Loukas (dkouzisloukas@scalingexcellence.co.uk)
# (c) 2011 Scaling Excellence
# For support and tutorials: http://scalingexcellence.co.uk/onready/

# onready extracts all the javascript from smarty template files
# and creates appropriate methods
# e.g. python onready.py demo/templates > demo/generated.js
#
# function indextpl() {
#     console.log("hello world");
# }

import re, os, sys, fnmatch
from pprint import pprint

def scan(root):
    dt={}
    for path, dirs, files in os.walk(root):
        for filename in fnmatch.filter(files, "*.tpl"):
            fname = os.path.join(path, filename)
            g = open(fname, 'r').read()
            vf = re.findall('{onready +ns *= *[\'"]([^\'"]+)[\'"]}(.*?){/onready}',g, re.S)
            for (k,v) in vf:
                if not k in dt:
                    dt[k] = []
                dt[k].append(v.replace("{literal}","").replace("{/literal}","").strip())
            
    return "\n".join([ "function sm_on_%s() {\n %s \n}" % (key,"\n    ".join(value)) for key, value in dt.items()])

if __name__ == '__main__':
    if (len(sys.argv)>=2):
        print scan(sys.argv[1])
    else:
        print scan(os.curdir)
