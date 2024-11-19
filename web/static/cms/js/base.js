var C = {
    Slice: Array.prototype.slice,
    G: function (Id) {
        return typeof (Id) == "string" ? document.getElementById(Id) : Id;
    },
    Ce: function (Tag) {
        return document.createElement(Tag);
    },
    Bd: function (D) {
        var D = D || document;
        return C.Gs(D.documentElement, "body")[0];
    },
    Gsn: function (Nm, Obj) {
        var Rst = document.getElementsByName(Nm);
        if (Obj || window.attachEvent) {
            Rst = [];
            var e = (C.G(Obj) || document).getElementsByTagName("*");
            for (var i = 0, len = e.length; i < len; i++) {
                if (e[i].tagName && e[i].getAttribute("name") == Nm) {
                    Rst[Rst.length] = e[i];
                }
            }
        }
        return Rst;
    },
    Gs: function (prt, tg, Progeny) {
        var prt = typeof (prt) == "string" ? C.G(prt) : prt, Childs = new Array(), Ds = prt.getElementsByTagName(tg),
            Progeny = !Progeny ? false : true;
        for (var i = 0; i < Ds.length; i++) {
            if (Ds[i].parentNode == prt || Progeny) {
                Childs.push(Ds[i]);
            }
        }
        return Childs;
    },
    DelClass: function (M, Cn) {
        if (M) {
            var Cls = M.getAttribute("class") || M.getAttribute("className");
            if (Cls) {
                if (RegExp("^\\s*" + Cn + "\\s*$").test(Cls)) {
                    C.DelAttr(M, "className");
                    C.DelAttr(M, "class");
                } else {
                    M.className = Cls.replace(new RegExp("( ?|^)" + Cn + "\\b"), "");
                }
            }
        }
    },
    AddClass: function (M, Cn) {
        if (M) {
            var Cls = M.getAttribute("class") || M.getAttribute("className");
            if (Cls != null) {
                Cn = Cls.indexOf(Cn) == -1 ? Cls + " " + Cn : Cls;
            }
            M.className = Cn;
        }
    },
    Attr: function (Id, Attr) {
        var obj = C.G(Id), oAttr;
        if (obj.getAttribute(Attr)) {
            oAttr = obj.getAttribute(Attr)
        } else if (obj.attributes[Attr]) {
            oAttr = obj.attributes[Attr];
        }
        return oAttr;
    },
    DelAttr: function (Id, Attr) {
        var obj = C.G(Id), oAttr;
        if (obj.getAttribute(Attr)) {
            obj.removeAttribute(Attr);
        } else if (obj.attributes[Attr]) {
            obj.removeAttributeNode(obj.attributes[Attr]);
        }
    },
    DelStyle: function (Ele) {
        if (Ele.getAttribute("style")) {
            Ele.removeAttribute("style");
        } else if (Ele.attributes["style"]) {
            Ele.removeAttributeNode(Ele.attributes["style"]);
        }
    },
    Sa: function (Sp, Intro) {
        var Sp = C.G(Sp), Cs = C.Gs(Sp, "input", true), Itr = null;
        if (Intro) {
            Itr = C.G(Intro);
        } else {
            switch (Sp.id.charAt(0).toUpperCase()) {
                case"F":
                    Itr = Cs.shift();
                    break;
                case"L":
                    Itr = Cs.pop();
                    break;
            }
        }
        C.AddEvent(Itr, "click", function () {
            for (var i = 0; i < Cs.length; i++) {
                if (Cs[i].type == "checkbox") {
                    Cs[i].checked = Itr.checked ? true : false;
                }
            }
        });
    },
    XHR: function () {
        var XHR;
        try {
            XHR = new XMLHttpRequest();
        } catch (e1) {
            try {
                XHR = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e2) {
                try {
                    XHR = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (e3) {
                    XHR = false;
                }
            }
        }
        return XHR;
    },
    EXHR: function (CallBack, Method, Url, Data, Proc, Async) {
        var oXHR = this.XHR(), Rst = null, Junctor = Url.indexOf("?") != -1 ? "&" : "?";
        oXHR.onreadystatechange = function () {
            switch (oXHR.readyState) {
                case 0:
                    Rst = "请求未初始化";
                    break;
                case 1:
                    Rst = "服务器连接已建立";
                    break;
                case 2:
                    Rst = "请求已接收";
                    break;
                case 3:
                    Rst = "请求处理中";
                    break;
                case 4:
                    Rst = "请求已完成，且响应已就绪";
                    if (oXHR.status == 200) {
                        var Rsp = null, cType = oXHR.getResponseHeader("Content-Type");
                        if (cType.indexOf("text/xml") != -1) {
                            Rsp = oXHR.responseXML
                        } else if (cType.indexOf("text/json") != -1 || cType.indexOf("text/html") != -1 || cType.indexOf("text/javascript") != -1 || cType.indexOf("application/javascript") != -1 || cType.indexOf("application/json") != -1 || cType.indexOf("application/x-javascript") != -1) {
                            Rsp = eval('(' + oXHR.responseText + ')');
                        } else {
                            Rsp = oXHR.responseText;
                        }
                        CallBack(Rsp);
                    }
                    break;
            }
            if (Proc) {
                Proc(Rst);
            }
        };
        Data = Method == "GET" ? null : Data;
        Async = Async != false ? true : false;
        oXHR.open(Method, encodeURI(Url), Async);
        if (Method == "POST") {
            oXHR.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        }
        oXHR.send(Data);
    },
    Collect: function (sUrl, Tit) {
        var sUrl = !sUrl ? document.URL : sUrl, Tit = !Tit ? document.title : Tit;
        try {
            window.external.addFavorite(sUrl, Tit);
        } catch (e) {
            try {
                window.sidebar.addPanel(Tit, sUrl, "");
            } catch (eb) {
                alert("对不起，您所使用的浏览器不允许点击收藏!\n请使用Ctrl+D进行收藏。");
            }
        }
    },
};
Function.prototype.Method = function (Nm, Fun) {
    if (!this.prototype[Nm]) {
        this.prototype[Nm] = Fun;
    }
};
String.Method("Trim", function () {
    return this.replace(/^\s+|\s+$/g, "");
});