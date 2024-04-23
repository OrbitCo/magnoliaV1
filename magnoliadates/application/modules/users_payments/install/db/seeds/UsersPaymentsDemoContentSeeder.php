<?php


use Phinx\Seed\AbstractSeed;

class UsersPaymentsDemoContentSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {
        $data = [
            0 => [
                'id' => 1,
                'id_user' => 3,
                'date_add' => '2016-03-25 16:25:13',
                'message' => 'Add funds',
                'price' => 112,
                'price_type' => 'add',
            ],
            1 => [
                'id' => 2,
                'id_user' => 1,
                'date_add' => '2016-03-25 16:25:14',
                'message' => 'Add funds',
                'price' => 112,
                'price_type' => 'add',
            ],
            2 => [
                'id' => 3,
                'id_user' => 2,
                'date_add' => '2016-03-25 16:25:14',
                'message' => 'Add funds',
                'price' => 112,
                'price_type' => 'add',
            ],
            3 => [
                'id' => 7,
                'id_user' => 4,
                'date_add' => '2016-03-25 17:29:21',
                'message' => 'Add funds',
                'price' => 112,
                'price_type' => 'add',
            ],
            4 => [
                'id' => 9,
                'id_user' => 5,
                'date_add' => '2016-03-25 17:35:28',
                'message' => 'Add funds',
                'price' => 100,
                'price_type' => 'add',
            ],
            5 => [
                'id' => 11,
                'id_user' => 6,
                'date_add' => '2016-03-25 17:42:21',
                'message' => 'Add funds',
                'price' => 180,
                'price_type' => 'add',
            ],
            6 => [
                'id' => 13,
                'id_user' => 7,
                'date_add' => '2016-03-25 17:45:56',
                'message' => 'Add funds',
                'price' => 170,
                'price_type' => 'add',
            ],
            7 => [
                'id' => 15,
                'id_user' => 8,
                'date_add' => '2016-03-25 17:50:46',
                'message' => 'Add funds',
                'price' => 200,
                'price_type' => 'add',
            ],
            8 => [
                'id' => 17,
                'id_user' => 9,
                'date_add' => '2016-03-25 17:57:05',
                'message' => 'Add funds',
                'price' => 80,
                'price_type' => 'add',
            ],
            9 => [
                'id' => 19,
                'id_user' => 10,
                'date_add' => '2016-03-25 18:02:09',
                'message' => 'Add funds',
                'price' => 160,
                'price_type' => 'add',
            ],
            10 => [
                'id' => 21,
                'id_user' => 11,
                'date_add' => '2016-03-25 18:05:31',
                'message' => 'Add funds',
                'price' => 115,
                'price_type' => 'add',
            ],
            11 => [
                'id' => 23,
                'id_user' => 12,
                'date_add' => '2016-03-25 18:16:31',
                'message' => 'Add funds',
                'price' => 187,
                'price_type' => 'add',
            ],
            12 => [
                'id' => 25,
                'id_user' => 13,
                'date_add' => '2016-03-25 18:25:07',
                'message' => 'Add funds',
                'price' => 133,
                'price_type' => 'add',
            ],
            13 => [
                'id' => 27,
                'id_user' => 14,
                'date_add' => '2016-03-25 18:31:05',
                'message' => 'Add funds',
                'price' => 318,
                'price_type' => 'add',
            ],
            14 => [
                'id' => 29,
                'id_user' => 15,
                'date_add' => '2016-03-29 15:54:54',
                'message' => 'Add funds',
                'price' => 87,
                'price_type' => 'add',
            ],
            15 => [
                'id' => 32,
                'id_user' => 16,
                'date_add' => '2016-03-29 16:13:53',
                'message' => 'Add funds',
                'price' => 200,
                'price_type' => 'add',
            ],
            16 => [
                'id' => 34,
                'id_user' => 15,
                'date_add' => '2016-03-29 16:33:33',
                'message' => 'Payment for service: Send message',
                'price' => 10,
                'price_type' => 'spend',
            ],
            17 => [
                'id' => 37,
                'id_user' => 2,
                'date_add' => '2016-03-30 12:47:21',
                'message' => 'Payment for service: Send message',
                'price' => 10,
                'price_type' => 'spend',
            ],
            18 => [
                'id' => 38,
                'id_user' => 1,
                'date_add' => '2016-03-30 18:36:34',
                'message' => 'Payment for service: Send message',
                'price' => 10,
                'price_type' => 'spend',
            ],
            19 => [
                'id' => 39,
                'id_user' => 1,
                'date_add' => '2016-05-04 15:53:19',
                'message' => 'Payment for service: Featured users',
                'price' => 10,
                'price_type' => 'spend',
            ],
            20 => [
                'id' => 40,
                'id_user' => 2,
                'date_add' => '2016-05-04 15:54:31',
                'message' => 'Payment for service: Featured users',
                'price' => 10,
                'price_type' => 'spend',
            ],
            21 => [
                'id' => 41,
                'id_user' => 3,
                'date_add' => '2016-05-04 15:54:53',
                'message' => 'Payment for service: Featured users',
                'price' => 10,
                'price_type' => 'spend',
            ],
            22 => [
                'id' => 42,
                'id_user' => 4,
                'date_add' => '2016-05-04 15:55:16',
                'message' => 'Payment for service: Featured users',
                'price' => 10,
                'price_type' => 'spend',
            ],
            23 => [
                'id' => 43,
                'id_user' => 6,
                'date_add' => '2016-05-04 15:55:39',
                'message' => 'Payment for service: Featured users',
                'price' => 10,
                'price_type' => 'spend',
            ],
            24 => [
                'id' => 44,
                'id_user' => 7,
                'date_add' => '2016-05-04 15:56:01',
                'message' => 'Payment for service: Featured users',
                'price' => 10,
                'price_type' => 'spend',
            ],
            25 => [
                'id' => 45,
                'id_user' => 8,
                'date_add' => '2016-05-04 15:56:28',
                'message' => 'Payment for service: Featured users',
                'price' => 10,
                'price_type' => 'spend',
            ],
            26 => [
                'id' => 46,
                'id_user' => 9,
                'date_add' => '2016-05-04 15:56:48',
                'message' => 'Payment for service: Featured users',
                'price' => 10,
                'price_type' => 'spend',
            ],
            27 => [
                'id' => 47,
                'id_user' => 10,
                'date_add' => '2016-05-04 15:57:18',
                'message' => 'Payment for service: Featured users',
                'price' => 10,
                'price_type' => 'spend',
            ],
        ];

        $this->table(DB_PREFIX . 'user_account_list')
            ->insert($data)
            ->saveData();
    }
}
