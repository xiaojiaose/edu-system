# edu-system

*- 项目地址：<https://edu-hebei-front.herokuapp.com/>
  - 前后端分离分开部署
    - [web](web) 前端代码
    - ./vendor/bin/phpcbf --standard=PSR2 
  - 测试账号，密码均为 `123456`
    - wang-school@163.com 
    - zhang-teacher@163.com 
    - student@163.com
    - 更多详见 database/seeds/config.php UserSeeder 部分
- Admin：<https://edu-hebei.herokuapp.com/admin>
  - 测试账号 admin:admin
  
- API Spec：[edu-system.yaml](edu-system.yaml)（完善中）**
- swagger 文档：<https://edu-hebei.herokuapp.com/swagger.htm>（完善中）**


## 项目提供了两种构建方式
- (本项目采用 * )基于heroku 提供的 <https://devcenter.heroku.com/articles/getting-started-with-laravel> Getting Started with Laravel on Heroku， 集成的PostgreSQL。状态可持续
- 基于docker的 用的sqlite的数据库，弊端每次构建数据库都会重置 状态非持续
- .env 走的heroku环境变量
## todo

- 前端调用接口时缺少 loading 提示
- 前端页面缺少分页
- api 接口缺少phpunit测试
- admin 中的缺少级联保存及删除