#!/usr/bin/python
# -*- coding: UTF-8 -*-
#pip3 install python-docx

import sys
import collections.abc
from pydocx import PyDocX
import pandas as pd
import aspose.slides as slides
# cd /www/fish/web/tool/python && sudo python3 doc.py xlsx /www/fish/web/upload/2024/12/03/0a140033c440278b257ed6d00c11a33f.xlsx
def main():
    """
     通过sys模块来识别参数demo, http://blog.csdn.net/ouyang_peng/
    """
    print('参数个数为:', len(sys.argv), '个参数。')
    print('参数列表:', str(sys.argv))
    print('脚本名为：', sys.argv[0])
    print("参数为",sys.argv[1])
    print("文档路径为",sys.argv[1]+".docx")
    if sys.argv[1]=="docx":
       docx(sys.argv[1])
    elif sys.argv[1]=="excel":
       excel(sys.argv[1])
    else:
       ppt(sys.argv[1])


def docx(source):
    # 使用假设的转换函数
    html = PyDocX.to_html(source)
    f = open(source+".html", 'w')#,encoding="utf-8"
    print("保存文件为：",source+".html")
    f.write(html)
    f.close()

def excel(source):
    # 读取Excel文件
    df = pd.read_excel(source)
    # 转换为HTML
    html = df.to_html()
    # 打印HTML或将其写入文件
    print(html)
    f = open(source+".html", 'w')#,encoding="utf-8"
    print("保存文件为：",source+".html")
    f.write(html)
    f.close()


def ppt(source):
    # 读取Excel文件
    # 加载演示文件
    pres = slides.Presentation(source)
    # 另存为 HTML
    pres.save(source+".html", slides.export.SaveFormat.HTML)




if __name__ == "__main__":
    main()
