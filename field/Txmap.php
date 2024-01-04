<?php
/**
 * Created by PhpStorm.
 * User: huawei
 * Date: 2024/1/4
 * Time: 20:22
 */

namespace iceand\field;


class Txmap
{

    /**
     * @title 地图组件
     * @param [
     * 'type'=>'txmap',
     * 'label'=>'字段名称',
     * 'field'=>'字段',
     * 'value'=>'值',
     * 'required'=>'是否必填',
     * 'param'=>[['field'=>'address','value'=>'详细地址'],['field'=>'lat','value'=>'纬度'],['field'=>'lng','value'=>'经度']]],
     * @param $item
     */
    public function main($item){
        $txmapkey = sysconf('data.txmapkey');
        $ajaxurl = url('addresstolatlng');
        $html = <<<EOT
        <div>
        <div style="display: flex;margin-bottom: 10px;">
            <input type="input" name="address"  value="{$item['param']['address']}" placeholder="地址" class="layui-input">
            <button type="button" class="layui-btn" onclick="address2latlng()">获取坐标</button>
        </div>
        <div style="display: block;margin-bottom: 10px;">
            <div class="layui-input-inline" style="width: 40px;">经纬度</div>
            <div class="layui-input-inline">
                <input type="input" name="lat"  value="{$item['param']['lat']}" placeholder="纬度" class="layui-input">
            </div>
            <div class="layui-input-inline">
                <input type="input" name="lng"  value="{$item['param']['lng']}" placeholder="经度" class="layui-input">
            </div>
                  <div style="clear: both;"></div>
        </div>
  
        <div id="txmap" style="width: 700px;height: 500px;">
        
</div>
</div>
        
<script charset="utf-8" src="https://map.qq.com/api/gljs?v=1.exp&key={$txmapkey}"></script>
<script type="text/javascript">
     var map
     var marker
      $(function(){
          layer.load()
          setTimeout(function(){
              layer.closeAll()
              var lat = parseFloat($('[name="lat"]').val() || '39.984104')  
              var lng = parseFloat($('[name="lng"]').val() || '116.307503')  
              initMap(lat,lng)
          },800)
         
      })
      function initMap(lat,lng){
          var center = new TMap.LatLng(lat, lng);
         
    
              // 初始化地图
              map = new TMap.Map('txmap', {
                zoom: 17, // 设置地图缩放
                center: new TMap.LatLng(lat, lng), // 设置地图中心点坐标，
                pitch: 0, // 俯仰度
                rotation: 0, // 旋转角度
              });
               marker = new TMap.MultiMarker({
                map: map,
                styles: {
                  // 点标记样式
                  marker: new TMap.MarkerStyle({
                    width: 20, // 样式宽
                    height: 30, // 样式高
                    anchor: { x: 10, y: 30 }, // 描点位置
                  }),
                },
                geometries: [
                  // 点标记数据数组
                  {
                    // 标记位置(纬度，经度，高度)
                    position: center,
                    id: 'marker',
                    styleId:"marker",
                  },
                ],
            });
            map.on("click",function(evt){
                var lat = evt.latLng.getLat().toFixed(6);
                var lng = evt.latLng.getLng().toFixed(6);
                setCenter(lat,lng)
                $("[name='lat']").val(lat)
                $("[name='lng']").val(lng)
                marker.updateGeometries([
                    {
                     "styleId":"marker",
                     "id": "marker",
                     "position": new TMap.LatLng(lat, lng),
                    }
                ])


            })   
      }
       function setCenter(lat,lng) {
            map.setCenter(new TMap.LatLng(lat,lng));//坐标为天安门
           
        }
        function address2latlng() {
            var address = $('[name="address"]').val()
            if(!address){
                $.msg.tips("请输入地址");
                return false
            }
            $.form.load('{$ajaxurl}', {address:address}, "post", function (ret) {
                 setCenter(ret.data.lat,ret.data.lng)
                $("[name='lat']").val(ret.data.lat)
                $("[name='lng']").val(ret.data.lng)
                marker.updateGeometries([
                    {
                     "styleId":"marker",
                     "id": "marker",
                     "position": new TMap.LatLng(ret.data.lat, ret.data.lng),
                    }
                ])
                return false;
            }, null, null, 'false'); 
        }
</script>
EOT;
        return $html;
    }
}