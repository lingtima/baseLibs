基于 Redis 的聊天系统
主要的两个存储结构：
```ini
群：chat:zset{userId=>readNumber}
用户易读：seen:zset{chatId=>readNumber
```
