<?php

namespace Tools\Pattern\Builder\User;

/**
 * 抽象用户：包换游客Visitor、普通用户Member、管理员Manager、借款人Borrower等等
 * 命名区别：
 * Visitor游客
 * Member用户，多跟业务/订单相关，比如年费会员
 * User范围比较广，基本包含了其他所有种类
 * Account账户，多跟支付账户相关
 * @package Tools\Pattern\Builder
 * @author lingtima@gmail.com
 */
abstract class AUser
{
    public function signIn()
    {
    
    }
    
    public function signOut()
    {
    
    }
    
    public function signUp()
    {
    
    }
    
    public function setPwd()
    {
    
    }
    
    public function updPwd()
    {
    
    }
    
    public function resetPwd()
    {
    
    }
    
    public function checkIn()
    {
    
    }
}
