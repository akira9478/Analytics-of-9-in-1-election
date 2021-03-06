# 2014九合一大選候選人分析網站
![image](https://github.com/akira9478/Analytics-of-9-in-1-election/blob/master/image/search.JPG)

## 製作緣由  
大三資料庫老師為了讓學生充分練習SQL及DB的使用  

恰巧時逢九合一大選  

https://zh.wikipedia.org/wiki/2014%E5%B9%B4%E4%B8%AD%E8%8F%AF%E6%B0%91%E5%9C%8B%E5%9C%B0%E6%96%B9%E5%85%AC%E8%81%B7%E4%BA%BA%E5%93%A1%E9%81%B8%E8%88%89  

於是就以此為題材讓學生以各階地方公職人員分配個人作業  

為甚麼需要寫到爬蟲分析器  

因為恰巧分到的~~14000多筆資料的~~村里長候選人數量找資料起來太耗時  

而且剛好有興趣就順便學習  

為了讓資料視覺化也加入了JS圖表  

以及讓查詢頁面更順暢的AJAX  


## 前端
css/js採用bootstrap簡單設計  

資料視覺化採用highcharts.js製作資料圖表  

為了讓候選人查詢的下拉式選單能不跳頁一直找到子搜尋村里鎮使用了AJAX  

## 後端
php操作sql及分析  
DB使用mysql  

## parser
使用simple_dom_html_parser爬中選會資料庫的資料  

分析後一鍵匯入至資料庫

## /sql/dbhw.sql
最後彙整的sql檔

## 功能
***
### 村里長查詢
以各縣市->各鄉鎮->各村里順序送出表單查詢  

下拉式選單採用ajax
![image](https://github.com/akira9478/Analytics-of-9-in-1-election/blob/master/image/search.JPG)

### 年齡分布
年齡分布長條圖
![image](https://github.com/akira9478/Analytics-of-9-in-1-election/blob/master/image/age.JPG)
### 姓氏菜市場名
姓氏統計圓餅圖  

可選擇200/500/1000數量低標搜尋前幾大姓氏
![image](https://github.com/akira9478/Analytics-of-9-in-1-election/blob/master/image/fn.JPG)
### 男女比例
兩性候選人/當選人比例
![image](https://github.com/akira9478/Analytics-of-9-in-1-election/blob/master/image/gender.JPG)
### 政黨平均年齡
各政黨候選人/當選人平均年齡
![image](https://github.com/akira9478/Analytics-of-9-in-1-election/blob/master/image/party.JPG)
### 連任比率
全國各政黨候選人連任比率

可選各縣市
![image](https://github.com/akira9478/Analytics-of-9-in-1-election/blob/master/image/re.JPG)

## 
