对象池模式
=====

## 目的

对象池模式是一种提前准备了一组已经初始化了的对象『池』而不是按需创建或者销毁的创建型设计模式。对象池的客户端会向对象池中请求一个对象，然后使用这个返回的对象执行相关操作。当客户端使用完毕，它将把这个特定类型的工厂对象返回给对象池，而不是销毁掉这个对象。

在初始化实例成本高，实例化率高，可用实例不足的情况下，对象池可以极大地提升性能。在创建对象（尤其是通过网络）时间花销不确定的情况下，通过对象池在可期时间内就可以获得所需的对象。

无论如何，对象池模式在需要耗时创建对象方面，例如创建数据库连接，套接字连接，线程和大型图形对象（比方字体或位图等），使用起来都是大有裨益的。在某些情况下，简单的对象池（无外部资源，只占内存）可能效率不高，甚至会有损性能。

## 意图

运用对象池化技术可以显著地提升性能，尤其是当对象的初始化过程代价较大或者频率较高时。

Object pooling can offer a significant performance boost; it is most effective in situations where the cost of initializing a class instance is high, the rate of instantiation of a class is high.

## 参与者

* Reusable      类的实例与其他对象进行有限时间的交互。
* ReusablePool  管理类的实例。
* Client        使用类的实例。

## 适用性

当以下情况成立时可以使用 Object Pool 模式：

类的实例可重用于交互。
类的实例化过程开销较大。
类的实例化的频率较高。
类参与交互的时间周期有限。

## 效果

节省了创建类的实例的开销。
节省了创建类的实例的时间。
存储空间随着对象的增多而增大。

## 相关模式

通常，可以使用 Singleton 模式实现 ReusablePool 类。
Factory Method 模式封装了对象的创建的过程，但其不负责管理对象。Object Pool 负责管理对象。