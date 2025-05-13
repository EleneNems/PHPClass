<!DOCTYPE html>
<html lang="ka">

<head>
    <meta charset="UTF-8">
    <title>OOP მაგალითები PHP-ში</title>
    <style>
        body {
            font-family: "Segoe UI", sans-serif;
            background-color: #f5f5f5;
            padding: 40px;
            color: #333;
        }

        .section {
            background-color: #fff;
            border-left: 6px solid #007acc;
            margin-bottom: 30px;
            padding: 20px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #007acc;
            margin-top: 0;
        }

        code {
            background-color: #f0f0f0;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.95em;
        }

        .output {
            background: #222;
            color: #0f0;
            padding: 10px;
            margin-top: 10px;
            font-family: monospace;
        }
    </style>
</head>

<body>

    <div class="section">
        <h2>1. კლასი და ობიექტი (Class & Object)</h2>
        <?php
        class Car
        {
            private $brand;
            protected $year;

            public function setBrand($brand)
            {
                $this->brand = $brand;
            }

            public function setYear($year)
            {
                $this->year = $year;
            }

            public function displayInfo()
            {
                echo "<div class='output'>ავტომობილი: {$this->brand}, გამოშვების წელი: {$this->year}</div>";
            }
        }

        $car1 = new Car();

        // პირდაპირი წვდომა აღარ იმუშავებს – რადგან brand არის private, year კი protected
        // $car1->brand = "Toyota";     
        // $car1->year = 2020;
        
        $car1->setBrand("Toyota");
        $car1->setYear(2020);
        $car1->displayInfo();
        ?>
    </div>

    <div class="section">
        <h2>2. მემკვიდრეობა (Inheritance)</h2>
        <?php
        class Animal
        {
            public function makeSound()
            {
                echo "<div class='output'>ცხოველი გამოსცემს ხმას</div>";
            }
        }

        class MyDog extends Animal
        {
            public function makeSound(): void
            {
                echo "<div class='output'>ძაღლი ამბობს: woof</div>";
            }
        }

        $dog = new MyDog();
        $dog->makeSound();
        ?>
    </div>

    <div class="section">
        <h2>3. ინკაფსულაცია (Encapsulation)</h2>
        <?php
        class BankAccount
        {
            private $balance = 0;

            public function deposit($amount)
            {
                if ($amount > 0) {
                    $this->balance += $amount;
                }
            }

            public function getBalance()
            {
                return $this->balance;
            }
        }

        $account = new BankAccount();
        $account->deposit(150);
        echo "<div class='output'>ბალანსი: " . $account->getBalance() . "</div>";
        ?>
    </div>

    <div class="section">
        <h2>4. პოლიმორფიზმი (Polymorphism)</h2>
        <?php
        class Circle
        {
            public function draw()
            {
                echo "<div class='output'>ვხატავ წრეს</div>";
            }
        }

        class Square
        {
            public function draw()
            {
                echo "<div class='output'>ვხატავ კვადრატს</div>";
            }
        }

        $shapes = [new Circle(), new Square()];
        foreach ($shapes as $shape) {
            $shape->draw();
        }
        ?>

    </div>

    <div class="section">
        <h2>5. კონსტრუქტორი და დესტრუქტორი (Constructor & Destructor)</h2>
        <?php
        class User
        {
            public $name;

            public function __construct($name)
            {
                $this->name = $name;
                echo "<div class='output'>მომხმარებელი {$this->name} შეიქმნა</div>";
            }

            public function __destruct()
            {
                echo "<div class='output'>მომხმარებელი {$this->name} წაიშალა</div>";
            }
        }

        $user = new User("გიორგი");
        //unset($user);
        ?>
    </div>

    <div class="section">
        <h2>6. ინტერფეისები (Interface)</h2>
        <?php
        interface Logger
        {
            public function log($message);
        }

        class FileLogger implements Logger
        {
            public function log($message)
            {
                echo "<div class='output'>ჩაწერა ფაილში: $message</div>";
            }
        }

        $logger = new FileLogger();
        $logger->log("შესვლა სისტემაში");
        ?>
    </div>

    <div class="section">
        <h2>6. აბსტრაქტული კლასი (Abstract Class)</h2>
        <?php
        abstract class Notification
        {
            abstract public function send($receiver, $message);

            public function format($message)
            {
                return strtoupper($message);
            }
        }

        class EmailNotification extends Notification
        {
            public function send($receiver, $message)
            {
                $formatted = $this->format($message);
                echo "<div class='output'>ელ.ფოსტა გაგზავნილია $receiver-ზე: $formatted</div>";
            }
        }

        $notifier = new EmailNotification();
        $notifier->send("user@example.com", "შესვლა დაფიქსირდა");
        ?>

    </div>

</body>

</html>