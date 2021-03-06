﻿using NUnit.Framework;
using Alipay.EasySDK.Factory;
using Alipay.EasySDK.Payment.Common.Models;
using System;

namespace UnitTest.Payment.Common
{
    public class ClientTest
    {
        [SetUp]
        public void SetUp()
        {
            Factory.SetOptions(TestAccount.Mini.CONFIG);
        }

        [Test]
        public void TestCreate()
        {
            string outTradeNo = Guid.NewGuid().ToString();
            AlipayTradeCreateResponse response = Factory.Payment.Common().Create("iPhone6 16G",
                    outTradeNo, "88.88", "2088002656718920");

            Assert.AreEqual(response.Code, "10000");
            Assert.AreEqual(response.Msg, "Success");
            Assert.Null(response.SubCode);
            Assert.Null(response.SubMsg);
            Assert.NotNull(response.HttpBody);
            Assert.AreEqual(response.OutTradeNo, outTradeNo);
            Assert.True(response.TradeNo.StartsWith("202"));
        }

        [Test]
        public void TestQuery()
        {
            AlipayTradeQueryResponse response = Factory.Payment.Common().Query("6f149ddb-ab8c-4546-81fb-5880b4aaa318");

            Assert.AreEqual(response.Code, "10000");
            Assert.AreEqual(response.Msg, "Success");
            Assert.Null(response.SubCode);
            Assert.Null(response.SubMsg);
            Assert.NotNull(response.HttpBody);
            Assert.AreEqual(response.OutTradeNo, "6f149ddb-ab8c-4546-81fb-5880b4aaa318");
        }

        [Test]
        public void TestCancel()
        {
            AlipayTradeCancelResponse response = Factory.Payment.Common().Cancel(CreateNewAndReturnOutTradeNo());

            Assert.AreEqual(response.Code, "10000");
            Assert.AreEqual(response.Msg, "Success");
            Assert.Null(response.SubCode);
            Assert.Null(response.SubMsg);
            Assert.NotNull(response.HttpBody);
            Assert.AreEqual(response.Action, "close");
        }

        [Test]
        public void TestClose()
        {
            AlipayTradeCloseResponse response = Factory.Payment.Common().Close(CreateNewAndReturnOutTradeNo());

            Assert.AreEqual(response.Code, "10000");
            Assert.AreEqual(response.Msg, "Success");
            Assert.Null(response.SubCode);
            Assert.Null(response.SubMsg);
            Assert.NotNull(response.HttpBody);
        }

        [Test]
        public void TestRefund()
        {
            AlipayTradeRefundResponse response = Factory.Payment.Common().Refund(CreateNewAndReturnOutTradeNo(), "0.01");

            Assert.AreEqual(response.Code, "40004");
            Assert.AreEqual(response.Msg, "Business Failed");
            Assert.AreEqual(response.SubCode, "ACQ.TRADE_STATUS_ERROR");
            Assert.AreEqual(response.SubMsg, "交易状态不合法");
            Assert.NotNull(response.HttpBody);
        }

        private string CreateNewAndReturnOutTradeNo()
        {
            return Factory.Payment.Common().Create("iPhone6 16G", Guid.NewGuid().ToString(),
                    "88.88", "2088002656718920").OutTradeNo;
        }
    }
}
