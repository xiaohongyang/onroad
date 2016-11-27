/**
 * 元素居中
 * @return {[type]} [description]
 */
!(function($){
    $.fn.pos = function (move, b) { //居中
        b = b || 2;
        var
            $t = $(this),
            t  = ($(window).outerHeight() - $t.outerHeight()) / b + $(window).scrollTop(),
            l  = ($(window).outerWidth() - $t.outerWidth()) / 2,
            ft = ($(window).outerHeight() - $t.outerHeight()) / b;
        // move ? $t.css('position', 'fixed') : $t.css({ top : t, left : l });
        // move ? $t.stop().animate({ top : t, left : l },30) : $t.css({ top : t, left : l });
        move ? $t.css({ top : ft, left : l}) : $t.css({ top : t, left : l });
        ($t.outerHeight() > $(window).outerHeight()) && $t.css({top: 10});
        return this;
    };
})(jQuery);

//x_say插件
!(function(){

    $(function(){
        /*var obj = $.x_say_m({
         cont : "dd", btnOption : { yesLabel:'退出'}, time : 2000,
         contStyle : {
         padding : '80px 60px 40px 60px'
         }
         });*/
        /*$(document).scroll(function(){
         (obj.border).pos();
         (obj.cont).pos();
         })*/
    })

    $.x_alert = function(option){
        var opt = {
            btn : [],
            size : [300, 150],
            time : 1500,
            contStyle : {
                padding : '60px 40px 30px 40px'
            }
        };
        opt = $.extend(opt, option);
        return $.x_say(opt);
    }

    $.x_say_m = function(option){
        var opt = {
            size : [490, 280]
        };
        opt = $.extend(opt, option);
        return $.x_say(opt);
    }
    $.x_say_x = function (option) {

        var opt = {
            btn : [],
            size : [300, 150],
            time : 1500,
            contStyle : {
                padding : '60px 40px 30px 40px'
            }
        }
        opt = $.extend(opt, option);
        return $.x_say(opt);
    }

    $.x_say = function(option){
        var opt = {
            title : '',
            bg : false,
            cont : '欢迎使用x_say弹出框！ qq:258082291',
            btn : ['yes','no'],
            size : [300,70],
            zIndex : 1060,
            time : 3000,
            closeBtnCont : '',
            callback : function(){},
            yesCallback : function(){},
            noCallback : function(){},
            borderStyle : {
                size : 12,
                bgColor : '#000',
                opacity : 0.3
            },
            noBtnExit : true,
            yesBtnExit : true,
            contStyle : {
                bgColor : '#fff',
                padding : '80px 60px 40px 60px ',
                textAlign : 'center'
            },
            btnOption : {
                yesClass : 'btn-warning',
                yesLabel : '确定',
                noClass : 'btn-primary',
                noLabel : '取消',
                marginTop : '90px'
            }
        };

        var exports = {}
        var wrapper,border,cont,closeBtn,bg,btnGroup,yes,no;
        var setOption = function(){
            //参数配置
            option.borderStyle = $.extend(opt.borderStyle, option.borderStyle)
            option.contStyle = $.extend(opt.contStyle, option.contStyle)
            option.btnOption = $.extend(opt.btnOption, option.btnOption)
            opt = $.extend(opt, option);
        }
        var setDom = function(){
            //dom配置
            wrapper = $("<div class='x_say_wrapper'></div>");
            border = $("<div class='x_say_border'></div>");
            cont = $("<div class='x_say_cont'></div>");
            closeBtn = $("<span class='x_say_close_btn'></span>");
            titleCont = $("<span class='x_say_title'></span>");
            bg = $("<div class='x_say_bg'></div>");
            btnGroup = $("<div class='x_say_btn_group'></div>")
            yes = $("<button class='yes btn'>"+opt.btnOption.yesLabel+"</button>");
            no = $("<button class='no btn' >"+opt.btnOption.noLabel+"</button>");

            cont.append(opt.cont);
            closeBtn.append(opt.closeBtnCont);
            titleCont.append(opt.title)

            cont.append(closeBtn);

            if(opt.title){
                cont.append(titleCont)
            }

            if(opt.btn.length===2){
                for(i in opt.btn){
                    if(opt.btn[i] == 'yes')
                        btnGroup.append(yes)
                    else
                        btnGroup.append(no)
                }
            }
            opt.btn.length===1 && opt.btn[0] == 'no' && btnGroup.append(no)
            opt.btn.length===1 && opt.btn[0] == 'yes' && btnGroup.append(yes)
            opt.btn.length > 0 && cont.append(btnGroup)
            wrapper.append(border, cont);

            if(opt.bg == true)
                wrapper.append(bg);

            $('body').append(wrapper);
        }
        var setStyle = function(){
            //样式设置
            btnGroup.css({
                'margin-top' : opt.btnOption.marginTop
            });
            border.css({
                width : (opt.size[0] + opt.borderStyle.size) + 'px',
                height : (opt.size[1] + opt.borderStyle.size) + 'px',
                background : opt.borderStyle.bgColor,
                opacity : opt.borderStyle.opacity,
                'z-index' : opt.zIndex
            });
            cont.css({
                width : opt.size[0],
                height : opt.size[1],
                background : opt.contStyle.bgColor,
                'z-index' : opt.zIndex,
                padding : opt.contStyle.padding,
                'text-align' : opt.contStyle.textAlign
            });
            opt.btnOption.yesClass && yes.addClass(opt.btnOption.yesClass);
            opt.btnOption.noClass && yes.addClass(opt.btnOption.noClass);
            bg.css({
                'width': '100%', 'height' : $(window).outerHeight(true), 'z-index': opt.zIndex-1,
                'left': 0, 'top': 0,
                position: 'absolute',
            })
            bg.css({width:$(window).outerWidth(true), height:$(document).outerHeight(true), opacity:option.opcity})
        }

        setOption();
        setDom();
        setStyle();

        var exportsConstruct = function(){
            exports.wrapper = wrapper;
            exports.border = border;
            exports.cont = cont;
            exports.cont.closeBtn = closeBtn;
            exports.btnGroup = btnGroup;
            exports.yes = yes;
            exports.no = no;
            exports._pos = function(){
                //居中显示
                exports.cont.pos();
                exports.border.pos();
            }
            exports._autoRemove = function(){
                if(opt.time > 0)
                    setTimeout(function(){
                        exports.wrapper._del();
                    }, opt.time)
            }

            exports.wrapper._del = function(){
                border.animate({
                    top:$(document).scrollTop(),
                    opacity:0
                },function(){
                    exports.wrapper.remove();
                });
                cont.animate({
                    top:$(document).scrollTop(),
                    opacity:0
                },function(){
                    exports.wrapper.remove();
                });

                opt.callback();
            }
            exports.cont.closeBtn.on('click', function () {
                exports.wrapper._del();
            })

            exports.yes.on('click', function(){
                yesResult = opt.yesCallback(exports, yes);
                if(opt.yesBtnExit == true && yesResult !== false)
                    exports.wrapper._del();
            })
            exports.no.on('click', function(){
                opt.noCallback(exports, no);
                if(opt.noBtnExit == true)
                    exports.wrapper._del();
            })

            exports._pos();
            exports._autoRemove();
        }

        exportsConstruct();

        return exports;
    }

})(jQuery)