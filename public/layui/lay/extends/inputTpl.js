/*
 * @Description: 输入框生成
 * @Author: Quan
 * @LastEditors: Please set LastEditors
 * @Date: 2019-04-13 09:54:31
 * @LastEditTime: 2019-04-23 16:59:11
 */

layui.define(
    [
        "laytpl",
        "element",
        "form",
        'eleTree',
        "formSelects",
        "dialog",
        "jquery",
        "upload",
        "request",
        "editor"
    ],
    function(exports) {
        var laytpl = layui.laytpl,
            $ = layui.$,
            element = layui.element,
            dialog = layui.dialog,
            eleTree = layui.eleTree,
            editor = layui.editor,
            upload = layui.upload,
            request = layui.request,
            formSelects = layui.formSelects,
            form = layui.form;
        var inputTpl = {
            html: function() {
                var html = "";

                html += '<script id="dialogTemplate" type="text/html">';
                html +=
                    "{{# layui.each(d.content, function(index, item){    }}";

                html += "{{# if(item.type=='tree') {  }}";
                html +='<div class="eleTree ele1 layui-col-md6 margin-top-0"  id="{{item.name}}Id" ></div>';
                html += "{{# }else {  }}";
                html += '<div class="layui-form-item ">';
                html +=
                    ' <label class="layui-form-label">{{item.label}}</label>';
                html += '<div class="layui-input-block">';
                html += '{{# if(item.type =="formSelect") { }}';
                html +=
                    '<select  name="{{item.name}}" xm-select="{{item.name}}Id"  >';
                html += '<option value=""></option>';
                html += "</select>";
                html += '{{# }else if(item.type =="select") { }}';
                html += '<select  name="{{item.name}}" id="{{item.name}}Id"  >';
                html += '<option value=""></option>';
                html +=
                    "{{# layui.each(item.optionData,function(index,option) { }}";
                html +=
                    '<option value="{{option.id}}"  {{option.checked?selected:""}} >{{option.name}}</option>';
                html += " {{# }); }}";
                html += "</select>";
                html += "{{# }else if(item.type=='textarea'){ }}";
                html +=
                    '<textarea id="{{item.name}}Id" name="{{item.name}}" class="layui-textarea" >{{item.value}}</textarea>';
                html += "{{# }else if(item.type=='editor'){ }}";
                html +=
                    '<div id="{{item.name}}Id" name="{{item.name}}" ></div>';
                html += "{{# }else if(item.type=='uploadImg') {  }}";
                html += '<div class="layui-upload">';
                html +=
                    '<button type="button" class="layui-btn" id="{{item.name}}Id">上传{{item.label}}</button>';
                html += '<div class="layui-upload-list">';
                html += '<img class="layui-upload-img" id="{{item.name}}Show">';
                html += "</div>";
                html += "</div>";
                html += "{{# }else if(item.type=='uploadGallery') {  }}";
                html += '<div class="layui-upload">';
                html +=
                    '<button type="button" class="layui-btn" id="{{item.name}}Id" >{{item.label}}相册上传</button>';
                html +=
                    '<blockquote class="layui-elem-quote layui-quote-nm" style="margin-top: 10px;">';
                html +=
                    '<div class="layui-upload-list" id="{{item.name}}Show"></div>';
                html += "</blockquote>";
                html += "</div>";
                html += "{{# }else {  }}";
                html +=
                    '<input type="{{item.inputType?item.inputType:"text"}}" name="{{item.name}}" placeholder="请输入{{item.label}}" ';
                html +=
                    'lay-skin="{{item.skin?item.skin:""}}"  value="{{item.skin?1:""}}"  lay-filter="{{item.filter?item.filter:""}}" lay-verType="{{item.verType?item.verType:"tips"}}"  {{item.submit?"lay-submit":""}}  lay-text="{{item.layText?item.layText:""}}" lay-verify="{{item.verify?item.verify:""}}" autocomplete="{{item.autocomplete?item.autocomplete:"off"}}" class="layui-input"/>';
                html += "{{# } }}";
                html += "{{# if(item.remark) { }}";
                html +=
                    ' <div class="layui-form-mid remark-font">*{{item.remark}}</div>';
                html += " {{# }; }}";
                html += "</div>";

                html += "</div>";
                html += " {{# } }}";
                html += " {{# }); }}";
               
                html +=
                    '<div class="layui-form-item {{d.button?"":"layui-hide"}}">';
                html += ' <label class="layui-form-label"></label>';
                html +=
                    '<button class="layui-btn" lay-submit lay-filter="{{d.layFilter?d.layFilter:"submit"}}" id="submit">提交</button>';
                html += "</div>";
                html += "</script>";
                return html;
            },
            render: function(jsonData) {

                let viewDom = jsonData.view ? jsonData.view : "inputContent";
                var data = jsonData;
                var getTpl = dialogTemplate.innerHTML,
                    view = document.getElementById(viewDom);
                laytpl(getTpl).render(data, function(html) {
                    view.innerHTML = html;
                });
                form.render();
                //数据渲染
                let tmpData = jsonData.content;
                let formValueObj = {};
                tmpData.find(function(item) {
                    if (item.type === "uploadImg") {
                        if (item.value) {
                            $("#" + item.name + "Show").attr("src", item.value);
                        }
                        request.uploadImg(item.name, item.uploadUrl);
                    } 
                    if(item.type==='tree'){
                        window.eleTree=eleTree.render(item.treeConfig);
                    //    el.reload();
                    }
                    if (item.type === "uploadGallery") {
                        if (item.value) {
                            item.value.forEach(url => {
                  
                                $("#" + item.name + "Show").append('<img src="' +url +'" " class="layui-upload-img">');
                            });
                        }
                        request.uploadGallery(item.name, item.uploadUrl);
                    }
                    if (item.type === "editor") {
                        editor.create(item.name + "Id");
                        if (item.value) {
                            window.editor[item.name + "Id"].txt.html(
                                item.value
                            );
                        }
                    }
                    if (
                        item.type != "uploadImg" &&
                        item.type != "editor" &&
                        item.type != "formSelect"
                    ) {
                        if (item.value) {
                            formValueObj[item.name] = item.value;
                        }
                    }
                    if (item.type == "formSelect") {
                        let configData = new Object();
                        configData = {
                            keyVal: "id",
                            keyName: "name",
                            keySel: "selected",
                            response: {
                                statusCode: 200 //规定成功的状态码，默认：0
                            },
                            success: function(id, url, searchVal, result) {
                                //使用远程方式的success回调
                                // console.log(
                                //     result.data,23111
                                // ); //返回的结果
                                if (!item.linkageWidth) {
                                    item.linkageWidth = 130;
                                }
                                let width = item.linkageWidth * 3;
                                $(".xm-select-parent .xm-form-select dl").css(
                                    "width",
                                    width
                                );
                                formSelects.value(
                                    item.name + "Id",
                                    item.value,
                                    true
                                );
                            }
                        };
                        if (item.header) {
                            configData.header = item.header;
                        }
                        if (item.keyName) {
                            configData.keyName = item.keyName;
                        }
                        if (item.keyVal) {
                            configData.keyVal = item.keyVal;
                        }
                        if (item.optionData) {
                            configData.data = item.optionData;
                        }
                        if (item.keyChildren) {
                            configData.keyChildren = item.keyChildren;
                        }
                        if (item.keySel) {
                            configData.keySel = item.keySel;
                        }
                        if (!item.linkage) {
                            configData.type = "get";
                            if (item.url) {
                                configData.searchUrl = item.url;
                            }
                        }
                        if (item.linkage) {
                            //是否开启联动
                            formSelects.config(item.name + "Id", configData);
                            var dataFormSelect = formSelects.data(
                                item.name + "Id",
                                "server",
                                {
                                    url: item.url,
                                    linkage: true,
                                    linkageWidth: item.linkageWidth
                                        ? item.linkageWidth
                                        : 130
                                }
                            );
                        } else {
                            formSelects.config(
                                item.name + "Id",
                                configData,
                                false
                            ); //linkage:是否开启联动请求方式: post, get, put, delete... //搜索地址, 默认使用xm-select-search的值, 此参数优先级高 //自定义返回数据中name的key, 默认 name //自定义返回数据中value的key, 默认 value //自定义返回数据中selected的key, 默认 selected
                        }
                        formSelects.render(item.name + "Id", {
                            skin: item.style ? item.style : "primary",
                            radio: item.selectMax == 1 ? true : false,
                            max: item.selectMax ? item.selectMax : 1,
                            height: "auto"
                        });
                    }
                });
                // console.log(formValueObj,2222);
                if (jsonData.formFilter) {
                    form.val(jsonData.formFilter, formValueObj);
                } else {
                    form.val("editForm", formValueObj);
                }
            }
        };
        exports("inputTpl", inputTpl);
    }
);
