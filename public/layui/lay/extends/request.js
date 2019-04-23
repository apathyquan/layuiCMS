layui.define(["jquery", "layer", "upload"], function(exports) {
    var $ = layui.$,
        layer = layui.layer,
        upload = layui.upload;
    var request = {
        /**
         *
         * @param {*} jsonData 配置参数
         * @param {*} Loading 是否开启等待效果
         * @param {*} type 加载效果类型支持值 支持0-2
         * @param {*} shade 是否开启加载效果蒙层 boolean
         */
        zqajax: function(jsonData, loading = false, type = 1, shade = false) {
            let headers = jsonData.headers
                ? jsonData.headers
                : {
                      "content-Type": "application/x-www-form-urlencoded",
                      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                          "content"
                      )
                  };
            if (loading) {
                $("#submit").attr("disabled", true);
                var loadingIndex = layer.load(type, { shade: shade });
            }

            $.ajax({
                type: jsonData.type,
                url: jsonData.url,
                data: jsonData.data,
                dataType: jsonData.dataType,
                headers: headers,
                success: function(res) {
                    // if (jsonData.hasOwnProperty('success')) {
                    //     jsonData.success(res);
                    jsonData.success && jsonData.success(res);
                },
                error: function(res) {
                    if (jsonData.hasOwnProperty("error")) {
                        jsonData.error(res);
                    } else {

                        layer.msg(res.responseJSON.message);
                    }
                },
                complete: function(res) {
                    layer.close(loadingIndex);
                    // layer.close(loadingIndex);
                    $("#submit").attr("disabled", false);
                    if (jsonData.hasOwnProperty("complete")) {
                        jsonData.complete(res);
                    }
                }
            });
        },
        loading: function(type = 0, shade = false) {
            return layer.load(type, { shade: shade }); //0代表加载的风格，支持0-2
        },
        uploadImg: function(field, url) {
            //单图上传
            // console.log(field, $('meta[name="csrf-token"]').attr("content"));
            var uploadInst = upload.render({
                elem: "#" + field + "Id",
                field: field,
                url: url,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                before: function(obj) {
                    //预读本地文件示例，不支持ie8
                    // obj.preview(function (index, file, result) {
                    //     $('#iconShow').attr('src', result); //图片链接（base64）
                    // });
                },
                done: function(res) {
                    //如果上传失败
                    if (!res.bool) {
                        return layer.msg("上传失败");
                    }

                    $("#" + field + "Show").attr("src", res.url); //图片链接（base64）

                    //上传成功
                },
                error: function() {
                    //演示失败状态，并实现重传
                    var demoText = $("#demoText");
                    demoText.html(
                        '<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>'
                    );
                    demoText.find(".demo-reload").on("click", function() {
                        uploadInst.upload();
                    });
                }
            });
        },
        uploadGallery: function(field, url) {
            //多图片上传
            var uploadInst2 =upload.render({
                elem: "#" + field + "Id",
                url: url,
                multiple: true,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                before: function(obj) {
                    //预读本地文件示例，不支持ie8

                },
                done: function(res) {
                    $("#" + field + "Show").append(
                        '<img src="' + res.url + '" " class="layui-upload-img">'
                    );
                },
                error: function() {
                    //演示失败状态，并实现重传
                    var demoText = $("#demoText");
                    demoText.html(
                        '<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>'
                    );
                    demoText.find(".demo-reload").on("click", function() {
                        uploadInst2.upload();
                    });
                }
            });
        }
    };
    exports("request", request);
});
