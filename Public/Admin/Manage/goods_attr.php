<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <?php include './Public/top.php'; ?>
    <script src="./Js/Plugin/CryptoJS/md5.js"></script>
    <title>商城属性管理</title>

    <script type="text/javascript">
        var specJson = {
            specHd: [{
                name:'货号',
                edit:false,
                type:'number'
            },{
                name:'型号',
                edit:true
            },{
                name:'颜色',
                edit:true
            },{
                name:'尺码',
                edit:true
            },{
                name:'原价',
                edit:false,
                reg: 'require price',
                msg: '原价不能为空 原价格式错误'
            },{
                name:'售价',
                edit:false,
                reg: 'require price',
                msg: '售价不能为空 售价格式错误'
            },{
                name:'库存',
                edit:false
            }],
            specBd: [{
                value01: "2015030201",
                value02: "GT520",
                value03: "红色",
                value04: "ML",
                value05: "360.52",
                value06: "888.20",
                value07: "50"
            }]
        }
        var specStatus = false;

        //开启规格
        var goodsSpecOpen = function(){
            $('#goodsSpecContent').append(TPL.goodsSpecHd(specJson));

            $('#goodsSpecOpen').hide();
            $('#goodsSpecOpen').siblings('.desc').html('您可以添加多种商品规格（如：颜色和尺码等）<br>规格名称可以自定义 如只有一项规格 其他项留空');
            $('#goodsSpecClose').show();
            $('#goodsSpecShuxing').hide().html('');
            Manage.uiInit($('#goodsSpecContent'));
            specStatus = true;
            goodsSpecDel();
        }

        //关闭规格
        var goodsSpecClose = function(){
            $('#goodsSpecContent').html('');

            $('#goodsSpecClose').hide();
            $('#goodsSpecClose').siblings('.desc').html('您可以添加多种商品规格（如：颜色和尺码等）<br>如商品没有规格则不用添加');
            $('#goodsSpecOpen').show();
            $('#goodsSpecShuxing').html(TPL.goodPrice()).show();
            Manage.uiInit($('#goodsSpecShuxing'));
            specStatus = false;
        }

        //添加新的规格属性
        var goodsSpecCopy = function(){
            var copyObj = $('.spec_bd ul:last-child').clone();
            var first = copyObj.find('li:first-child');
            var lastLi = copyObj.find('li:last-child');
            first.find('input').val('货号会自动生成');
            if(lastLi.attr('data-status') == 'empty'){
                lastLi.removeAttr('data-status');
                lastLi.html('<a href="javascript:void(0);" target="specDel" class="btn_del">删除</a>');
            }
            $('.spec_bd').append(copyObj);
            Manage.uiInit($('#goodsSpecContent'));
            goodsSpecDel();
        }

        //删除规格属性
        var goodsSpecDel = function(){
            $('a[target=specDel]').each(function(){
                var $this = $(this);
                $this.off('click').on('click', function(){
                    var $this = $(this);
                    $this.parents('.spec_item').remove();
                })
            })
        }

        //保存
        var saveSpecData = function(){
            if(!specStatus){
                return;
            }

            var specHdData = specJson.specHd;
            var dataArr = {
                editIndex: {},
                checkName: {},
                checkData: {}
            };
            var specCopy = {
                specBd:[]
            }
            for(var i = 0,len = specHdData.length;i < len;i++){
                if(specHdData[i].edit){
                    var name = $('.spec_hd').find('li').eq(i).find('input').val();
                    if(name && name != ''){
                        dataArr.hasEdit = true;
                        dataArr.editIndex[i] = true;

                        if(!dataArr.checkName[CryptoJS.MD5(name)]){
                            dataArr.checkName[CryptoJS.MD5(name)] = true;
                        }else{
                            Juuz.tipsMsg('存在重复的规格名称: '+name);
                            return false;
                        }
                    }
                    specHdData[i].name = name;
                }else{
                    var name = specHdData[i].name;
                }
            }
            if(!dataArr.hasEdit){
                Juuz.tipsMsg('规格名称至少填一项！');
                return false;
            }

            var specBdData = $('.spec_bd').find('ul');
            for(var i = 0;i < specBdData.length;i++){
                var specBdObj = {};
                specBdLiData = $(specBdData[i]).find('input');
                var _nameStr = "";
                for(var j = 0;j < specBdLiData.length;j++){
                    var value = $(specBdLiData[j]).val();
                    var bool = dataArr.editIndex[j] || false;
                    if(value == '' && bool){
                        Juuz.tipsMsg('规格填写不完整！');
                        return false;
                    }
                    if(bool){
                        _nameStr += value + ",";
                    }
                    var _reg = specHdData[j].reg || '';        //正则验证
                    var _msg = specHdData[j].msg || '';        //验证提示消息
                    if(_reg){
                        var _rule = _reg.split(" ");
                        var _msgs = _msg.split(" ");
                        for(k in _rule){
                            var _msgNow = _msgs[k] ? _msgs[k] : _msgs[0];
                            if(!Juuz.regex(_rule[k], value)){
                                Juuz.tipsMsg("规格："+_nameStr+_msgNow);
                                return false;
                            }
                        }
                    }
                    specBdObj['value0'+(j+1)] = value;
                }
                if(!dataArr.checkData[CryptoJS.MD5(_nameStr)]){
                    dataArr.checkData[CryptoJS.MD5(_nameStr)] = true;
                }else{
                    Juuz.tipsMsg('存在重复的规格: '+_nameStr, 2000);
                    return false;
                }
                specCopy.specBd.push(specBdObj);
            }
            specCopy.specHd = specHdData;

            var specStr = Juuz.json2str(specCopy);
            $('#specStr').val(specStr);

            return true;
        }

        $(function(){
            if(specJson.specBd != ""){
                goodsSpecOpen();
            }
        })

    </script>
</head>
<body>
    <!-- 头部 -->
    <?php include './Public/header.php' ?>

    <div class="body">
        <div class="inner clearfix">
            <div class="col_side">
                <?php
                    define("SELECT_MENU", "goods_attr");
                ?>
                <!-- 左侧菜单栏 -->
                <?php include './Public/leftMenu.php' ?>
            </div>
            <div class="col_main">
                <div class="main_hd">
                    <h2>商城管理</h2>
                    <div class="title_tab">
                        <ul class="tab_ul dib-wrap">
                            <li class="dib selected"><a href="goods_attr.php">商品属性</a></li>
                        </ul>
                        <div class="tab_navs">
                            <div class="search_box">
                                <form action="" method="post">
                                    <input type="text" name="searchText" />
                                    <button type="submit" class="btn_search_submit"></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main_bd">
                    <form class="clearfix" action="" method="post" onsubmit="return Juuz.ajaxForm(this);">
                        <div class="ui_col_18">
                            <div id="goodsSpecShuxing">
                                <div class="ui_col_6">
                                    <span class="ui_label">原价</span>
                                    <input type="text" class="ui_text_input" name="price" data-opt='{
                                        type: "require",
                                        msg: "原价不能为空"
                                    }' />
                                </div>
                                <div class="ui_col_6">
                                    <span class="ui_label">优惠价</span>
                                    <input type="text" class="ui_text_input" name="price2" data-opt='{
                                        type: "require",
                                        msg: "优惠价不能为空"
                                    }' />
                                </div>
                                <div class="ui_col_6">
                                    <span class="ui_label">库存</span>
                                    <input type="text" class="ui_text_input" name="kucun" data-opt='{
                                        type: "require number",
                                        msg: "库存不能为空 库存格式错误"
                                    }' />
                                </div>
                            </div>
                            <div class="ui_col_18">
                                <span class="ui_label">规格</span>
                                <div class="goods_spec">
                                    <div class="no_spec">
                                        <a href="javascript:goodsSpecOpen();" id="goodsSpecOpen" class="ui_button r3">开启规格</a>
                                        <a href="javascript:goodsSpecClose();" id="goodsSpecClose" class="ui_button r3" style="display:none;">关闭规格</a>
                                        <p class="desc">
                                            您可以添加多种商品规格（如：颜色，尺码等）<br>
                                            如商品没有规格则不用添加
                                        </p>
                                    </div>
                                    <div id="goodsSpecContent" class="has_spec clearfix"></div>
                                </div>
                            </div>
                            <div class="ui_col_18 pt20 pb20">
                                <button class="ui_button r3" type="submit" onclick="return saveSpecData()">提 交</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>