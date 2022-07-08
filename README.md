# module-order-data-erp-amqp
-- Save order data to amqp and send the processed data API async to ERP.

-- Test Scenario

Let's say that I have an Magento CE 2.4.4 instance running and I want it to send data to an external (3rd Party) ERP (as an example here) system for order fulfillment reasons.
For every new order I want to send some of its details asynchronously through API to the ERP. 
The main achievement here is the use of the Message Queue features provided by Magento to send the order details in a reliable way.



-- Requirements

- On every new order, the Message Queue (RabbitMQ) will receive a new message containing the order ID, the email address of the customer, and the amount of items in the cart, and the same information should be logged using the default logger.
- Orders information in the Message Queue will be periodically processed and sent to the ERP using asyncronous.
- Orders that are successfully sent to the ERP will have their status changed from “new” to “processing”.
- Every requests attempt must be logged to a database table. The following information must be recorded: order ID, timestamp, return response code from the ERP.
- The database table containing the requests records will never be empty. On table creation, a single line will be created, with order ID 0, current timestamp at creation time, and return code 999.
- An html page, in the frontend, reachable at /erpapirequests/index/index will show the last 10 requests' attempts.
- There will be a CLI command that lists the last 10 successful requests attempts, or the last 10 failed attempts, based on an argument passed to it.
