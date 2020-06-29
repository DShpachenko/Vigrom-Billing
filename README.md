# Методы API

Получение баланса:
<pre>
Запрос GET - http://vigrom-billing.local/api/billing/balance/show:
{
    "wallet_id": 241
}
</pre>

Обновление баланса:
<pre>
Запрос POST - http://vigrom-billing.local/api/billing/balance/update
{
    "wallet_id": 241,
    "type": "debit",
    "reason": "refund",
    "currency": "RUB",
    "sum": 69.0341
}
</pre>
