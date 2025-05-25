<?php

namespace Tests\Unit;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\UserService;
use Mockery;
use PHPUnit\Framework\TestCase;

class UserServiceTest extends TestCase
{
    public function test_get_user_returns_expected_user()
    {
        // Tạo mock cho repository
        $mockRepo = Mockery::mock(UserRepositoryInterface::class);

        // Giả lập kết quả khi gọi ->find(1)
        $mockRepo->shouldReceive('find')
            ->with(1)
            ->once()
            ->andReturn((object)[
                'id' => 1,
                'name' => 'Test User'
            ]);

        // Inject mock vào service
        $service = new UserService($mockRepo);

        // Gọi hàm và kiểm tra
        $user = $service->getUser(1);

        $this->assertEquals('Test User', $user->name);
        $this->assertEquals(1, $user->id);
    }
}
