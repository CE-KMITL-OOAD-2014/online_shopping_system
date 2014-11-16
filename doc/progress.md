#### ชื่อกลุ่ม N&N 
#### Sellon : onlineShopingSystem
- นาย ณัฏฐ์ จึงมาริศกุล

- นาย ธนภณ ซู

##***PROGRESS***
- ระบบสมาชิก
  - พัฒนาสำเร็จแล้ว สามารถสมัครสมาชิก ล็อกอินและแก้ไข
- ระบบเพิ่ม/แก้ไข/ลบ สินค้า
  - พัฒนาสำเร็จแล้ว สามารถเพิ่มสินค้า อัพโหลดรูปภาพและแก้ไขข้อมูลสินค้าได้
- แสดง และ ค้นหาสินค้า 
  - พัฒนาเสร็จแล้ว สามารถค้นหาสินค้าจากคุณสมบัติใดของสินค้าก็ได้
- ระบบสั่งซื้อสินค้า
  - ส่วนหลักของระบบเสร็จแล้ว แต่ยังไม่มีระบบตระกร้าสินค้าและส่วนติดต่อผู้ใช้งาน  
- แก้ไข/ลบ/ตรวจสอบการสั่งซื้อ และ ระบบรายงานผลประกอบการ
  - ยังไม่เริ่มพัฒนาส่วนนี้ เนื่องจากระบบสั่งซื้อยังไม่เสร็จ จะแก้ไขโดยการเพิ่มจำนวนชั่วโมงในการทำงาน    
- ระบบ instant message
   - ยังไม่เริ่มพัฒนา กำลังศึกษา library ที่จะนำมาใช้

##***TEST***
ระบบมีส่วนในการ ทดสอบ 2 ระบบ ประกอบไปด้วยระบบดังนี้

- **Product Repository Test**

	การทดสอบระบบในส่วนของ Product ซึ่งเป็นการทดสอบ function ต่างๆใน \core\Product ( class product ที่สร้างเอง ) และลอง Mock \Product ( class product ที่ extend Eloquent ) แล้วส่งเข้าไปทำการเซฟ object \Product 
	- directory อยู่ที่ online_shopping_system/app/tests/ 
	- สามารถเข้าไปดูที่ https://github.com/CE-KMITL-OOAD-2014/online_shopping_system/blob/feature/productManage/app/tests/ProductRepoTest.php

- **Buying Test**

	ทดสอบระบบซื้อสิ้นค้า โดยลองสร้าง object ของ class \core\Product แล้วทำการซื้อ จากนั้นดูว่า Order ที่เกิดขึ้นถูกต้องหรือไม่
	- directory อยู่ที่ online_shopping_system/app/tests/
	- สามารถเข้าไปดูที่ https://github.com/CE-KMITL-OOAD-2014/online_shopping_system/blob/develop/app/tests/BuyingTest.php
    
##***Evaluation***

####***การทดลองระบบจัดการสินค้า***

**จุดประสงค์ในการทดลอง** : เพื่อทดสอบระบบสินค้าว่าสามารถใช้งานได้จริง

**สิ่งที่จะวัด** : หากระบบสามารถทำการเพิ่มสินค้าได้ เมื่อเพิ่มรายการเสร็จ จะมีสินค้าชนิดนั้นๆ อยู่ที่หน้าแสดงรายการสินค้าทั้งหมด 

**วิธีทำการทดลอง** : การทดลองสามารถทำได้โดยการทดลองกับระบบจริงๆ โดยมีสิ่งที่ต้องใช้ในการทดลองระบบดังนี้

 - Production server environment
 - ข้อมูลรูปแบบต่างที่เป็นไปได้ในการใช้งานจริง พร้อมรูปภาพขนาดต่างๆ
 - Browser สำหรับการทดลอง

**โดยทำการทดลองดังนี้**

1 ทดลองใส่ข้อมูลจำลอง ที่เตรียมเอาไว้ 

2 อัพโหลดไฟล์ภาพของสินค้าชนิดนั้นๆ

3 ทำการยืนยัน เพื่อบันทึกสินค้าลงบนฐานข้อมูล

4 ทดสอบกลับไปที่หน้าแสดงผลสินค้า แล้วตรวจสอบว่ามีสินค้าเพิ่งเพิ่มเข้าไปในระบบหรือไม่

5 ทดสอบการแก้ไข สินค้า โดยเลือกสัญลักษณ์การแก้ไขสินค้าในรายการสินค้า

6 ทดสอบแก้ไขสินค้าใน ฟิลด์ ต่างๆ แล้วทำการยืนยัน 

7 ที่หน้าแสดงผลสินค้า ลองตรวจสอบดูว่าข้อมูลแก้ไขตามที่ต้องการหรือไม่

8 ทดสอบการลบสินค้า โดยการคลิกที่ปุ่มลบสินค้า

9 หลังจากลบสินค้ารูปของสินค้านั้นก็ควรจะต้องหายไปด้วย ลองไปเช็คว่ายังมีรูปสินค้านั้นในไดเรกทอรี่รูปภาพ หรือไม่ 

10 ทำการทดสอบขั้นตอน 1 - 9 กับข้อมูลในรูปแบบต่างๆกันให้ครบทุกรูปแบบ

**ผลการทดลอง**

 ยังไม่ได้ทำการทดลอง
 
**สรุปสิ่งที่ได้จากการทดลอง**

ยังไม่ได้ทำการทดลอง




####**การทดลองระบบสั่งซื้อสินค้า**

**จุดประสงค์ในการทดลอง** เพื่อทดสอบความถูกต้องในการทำงาน ของระบบการสั่งซื้อ
    
**สิ่งที่จะวัด** : หากผู้ใช้สามารถทำการซื้อสินค้าได้ จะมีรายการสั่งซื้อสินค้าเกิดขึ้นในระบบ โดยที่ราคารวมของสินค้าและวันเวลาการสั่งซื้อ จะต้องตรงตามข้อมูลจริง

**วิธีทำการทดลอง** : การทดลองสามารถทำโดย ให้ผู้ใช้ทดลองใช้งานระบบจริงๆ โดยมีสิ่งที่ต้องใช้ในการทดลองระบบดังนี้

1.Production server environment

2.ข้อมูลสินค้าในระบบสำหรับทำการทดลองซื้อ

3.Browser สำหรับการทดลอง

โดยทำการทดลองดังนี้ 

1.ให้ผู้ใช้ที่มีสิทธิ์เป็นลูกค้ากดสั่งซื้อสินค้า

2.ระบุจำนวนที่ต้องการสั่งซื้อ

3.ยืนยันการสั่งซ์้อ

4.ผู้ใช้ที่มีสิทธิ์เป็นเจ้าของร้านเข้าสู่ระบบ

5.ตรวจสอบว่ามีการสั่งซื้อใหม่เกิดขึ้นจริง

6.ตรวจสอบว่าจำนวนสินค้าคงเหลือในระบบลดลงตามจำนวนที่ลูกค้าสั่งซื้อ

**ผลการทดลอง**

ยังไม่ได้ทำการทดลอง

**สรุปสิ่งที่ได้จากการทดลอง**

ยังไม่ได้ทำการทดลอง