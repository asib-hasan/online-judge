<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Python Mastery: Beginner to Pro') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ activeTab: 1 }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col md:flex-row">
                
                <!-- Sidebar -->
                <div class="w-full md:w-1/4 bg-gray-50 border-r border-gray-200 h-[80vh] overflow-y-auto">
                    <ul class="py-4">
                        <template x-for="item in [
                            { id: 1, title: '1. Running Python' },
                            { id: 2, title: '2. Variables & Data Types' },
                            { id: 3, title: '3. Input & Output' },
                            { id: 4, title: '4. Operators' },
                            { id: 5, title: '5. Conditional Statements' },
                            { id: 6, title: '6. Loops' },
                            { id: 7, title: '7. Basic Math Operations' },
                            { id: 8, title: '8. Strings' },
                            { id: 9, title: '9. Lists (Arrays)' },
                            { id: 10, title: '10. Basic Functions' },
                            { id: 11, title: '11. Type Conversion' },
                            { id: 12, title: '12. Dictionaries' },
                            { id: 13, title: '13. Sets' },
                            { id: 14, title: '14. Tuples' },
                            { id: 15, title: '15. List Comprehensions' },
                            { id: 16, title: '16. Fast I/O' },
                            { id: 17, title: '17. Sorting' },
                            { id: 18, title: '18. Built-in Tools' },
                            { id: 19, title: '19. 2D Arrays (Grids)' },
                            { id: 20, title: '20. Time Complexity' }
                        ]" :key="item.id">
                            <li>
                                <button @click="activeTab = item.id" 
                                    :class="{'bg-indigo-50 border-indigo-500 text-indigo-700 font-bold': activeTab === item.id, 'border-transparent text-gray-600 hover:bg-gray-100 hover:text-gray-900': activeTab !== item.id}" 
                                    class="w-full text-left px-6 py-3 border-l-4 transition-colors duration-150 ease-in-out text-sm"
                                    x-text="item.title">
                                </button>
                            </li>
                        </template>
                    </ul>
                </div>

                <!-- Content Area -->
                <div class="w-full md:w-3/4 p-8 h-[80vh] overflow-y-auto prose max-w-none">
                    
                    <!-- Section 1 -->
                    <div x-show="activeTab === 1" x-cloak>
                        <h1 class="text-3xl font-bold mb-4 text-gray-800 border-b pb-2">1. Running Python</h1>
                        
                        <h3 class="text-xl font-bold mt-6 mb-2 text-indigo-700">What is Python and how does it work?</h3>
                        <p class="text-gray-600 mb-2">Computers only speak in 1s and 0s (binary). Writing binary is impossible for humans. Python is a <strong>translator</strong> (called an interpreter). You write instructions in simple, human-readable English, and Python instantly translates it into binary so the computer can act.</p>
                        <p class="text-gray-600 mb-4">Unlike older languages (like C++ or Java) where you have to manually "compile" your code before running it, Python reads and executes your code line-by-line immediately. This makes it the best language for rapid testing and competitive programming!</p>
                        
                        <h3 class="text-xl font-bold mt-6 mb-2 text-gray-800">Code Example: Making the computer speak</h3>
                        <div class="bg-slate-900 rounded-md p-4 mb-4">
                            <pre><code class="text-green-400"># The '#' symbol creates a Comment. 
# Comments are notes for humans. Python completely ignores them.

# The print() function tells the computer to show text on the screen.
print("Hello, World!")
print("Welcome to the Online Judge!")

# To run this, you would save it as 'main.py' and type this in your terminal:
# python main.py</code></pre>
                        </div>
                    </div>

                    <!-- Section 2 -->
                    <div x-show="activeTab === 2" x-cloak>
                        <h1 class="text-3xl font-bold mb-4 text-gray-800 border-b pb-2">2. Variables & Data Types</h1>
                        
                        <h3 class="text-xl font-bold mt-6 mb-2 text-indigo-700">What is a Variable?</h3>
                        <p class="text-gray-600 mb-2">Think of a variable as a labeled moving box. When you get new data, you put it in the box, slap a label on it, and store it in the computer's memory. Whenever you need that data again, you just call the label.</p>
                        <p class="text-gray-600 mb-4">In Python, you don't have to tell the computer what <em>type</em> of data is going into the box. Python is smart enough to look at the data and figure it out automatically (this is called "dynamic typing").</p>
                        
                        <h3 class="text-xl font-bold mt-6 mb-2 text-gray-800">The 4 Main Types of Data</h3>
                        <div class="bg-slate-900 rounded-md p-4 mb-4">
                            <pre><code class="text-green-400"># 1. Integer (Whole numbers: positive, negative, or zero)
player_score = 150
temperature = -5

# 2. Float (Decimal numbers: used for exact measurements)
# Fun fact: Computers struggle to store decimals perfectly!
# Always use floats for money, distances, or percentages.
item_price = 19.99  
win_rate = 0.75

# 3. String (Text characters)
# Strings MUST be wrapped in "double" or 'single' quotes.
player_name = "Alice"

# 4. Boolean (True or False switches)
# These MUST be capitalized. They are the core of computer logic.
game_is_over = False
has_magic_key = True</code></pre>
                        </div>
                    </div>

                    <!-- Section 3 -->
                    <div x-show="activeTab === 3" x-cloak>
                        <h1 class="text-3xl font-bold mb-4 text-gray-800 border-b pb-2">3. Input & Output</h1>
                        
                        <h3 class="text-xl font-bold mt-6 mb-2 text-indigo-700">How do we talk to the user?</h3>
                        <p class="text-gray-600 mb-2">Programs are interactive. <strong>Input</strong> is how your program pauses and waits for the user to type something on their keyboard. <strong>Output</strong> is how your program displays the result on the monitor.</p>
                        <p class="text-gray-600 mb-4"><strong>The Golden Rule of Input:</strong> Whenever a user types something, Python treats it as a String (Text). Even if they type "50", Python sees it as the word "50", not the mathematical number 50. If you want to do math with it, you must convert it first!</p>
                        
                        <h3 class="text-xl font-bold mt-6 mb-2 text-gray-800">Code Example: A simple conversation</h3>
                        <div class="bg-slate-900 rounded-md p-4 mb-4">
                            <pre><code class="text-green-400"># 1. Getting Input
name = input("What is your name? ")

# If we want an age to do math, we wrap input() inside int()
age = int(input("How old are you? "))

# 2. Advanced Output (f-strings)
# To mix variables and text easily, put an 'f' before the quotes!
# Then put your variables inside {curly brackets}.
print(f"Hello {name}, next year you will be {age + 1} years old!")</code></pre>
                        </div>
                    </div>

                    <!-- Section 4 -->
                    <div x-show="activeTab === 4" x-cloak>
                        <h1 class="text-3xl font-bold mb-4 text-gray-800 border-b pb-2">4. Operators</h1>
                        
                        <h3 class="text-xl font-bold mt-6 mb-2 text-indigo-700">Doing Math and Making Comparisons</h3>
                        <p class="text-gray-600 mb-2">Operators are symbols that tell the computer's processor to do calculations. You have standard math, but programming also relies heavily on <strong>Comparison Operators</strong> (which check if things are equal/greater) and <strong>Logical Operators</strong> (which chain multiple checks together).</p>
                        <p class="text-gray-600 mb-4">The most important math operator to learn is the <strong>Modulus (%)</strong>. It divides two numbers and gives you the <em>remainder</em>. It is used constantly in programming to check if a number is Even or Odd (if `num % 2 == 0`, it's even!).</p>
                        
                        <h3 class="text-xl font-bold mt-6 mb-2 text-gray-800">Code Example: The Operators</h3>
                        <div class="bg-slate-900 rounded-md p-4 mb-4">
                            <pre><code class="text-green-400">x = 10
y = 3

# --- MATH ---
print(x / y)   # 3.3333... (Normal division always creates a Float)
print(x // y)  # 3 (Floor division: cuts off the decimal)
print(x % y)   # 1 (Modulus: The remainder of 10 divided by 3)
print(x ** 2)  # 100 (Exponent: x to the power of 2)

# --- COMPARISONS (Always output True or False) ---
print(x == 10)  # True (Checking equality. Note: single = is for assigning variables!)
print(x != 5)   # True (Not equal to)
print(x >= 10)  # True (Greater than OR equal to)

# --- LOGIC ---
# 'and' requires BOTH sides to be True. 'or' requires ONLY ONE to be True.
print(x > 5 and y < 5)  # True</code></pre>
                        </div>
                    </div>

                    <!-- Section 5 -->
                    <div x-show="activeTab === 5" x-cloak>
                        <h1 class="text-3xl font-bold mb-4 text-gray-800 border-b pb-2">5. Conditional Statements</h1>
                        
                        <h3 class="text-xl font-bold mt-6 mb-2 text-indigo-700">How Computers Make Decisions</h3>
                        <p class="text-gray-600 mb-2">Normally, code runs from top to bottom, line by line. Conditionals allow your code to take different paths. It asks a question (like "Is the score > 90?"). If the answer is True, it runs a specific block of code. If False, it skips it.</p>
                        <p class="text-gray-600 mb-4">In Python, blocks of code are grouped by <strong>indentation (spaces)</strong>. Everything indented under the `if` statement belongs to it. The moment you stop indenting, you are back to the main program.</p>
                        
                        <h3 class="text-xl font-bold mt-6 mb-2 text-gray-800">Code Example: The If/Elif/Else Chain</h3>
                        <div class="bg-slate-900 rounded-md p-4 mb-4">
                            <pre><code class="text-green-400">score = 85

# The computer checks these one by one, top to bottom.
if score >= 90:
    print("Grade: A")
    print("Great job!")
    
elif score >= 80:  # 'elif' stands for 'Else If'
    print("Grade: B")
    
else:  # If everything above was False, 'else' is the final catch-all.
    print("Grade: C or lower")

# Note: Once the computer finds a True statement, it runs that block
# and completely IGNORES the rest of the chain! Since score is 85,
# it prints "Grade: B" and skips the 'else' block.</code></pre>
                        </div>
                    </div>

                    <!-- Section 6 -->
                    <div x-show="activeTab === 6" x-cloak>
                        <h1 class="text-3xl font-bold mb-4 text-gray-800 border-b pb-2">6. Loops</h1>
                        
                        <h3 class="text-xl font-bold mt-6 mb-2 text-indigo-700">Automating Repetition</h3>
                        <p class="text-gray-600 mb-2">Computers are fast. If you need to print "Hello" a million times, you don't write it a million times—you write a Loop. There are two main types of loops:</p>
                        <ul class="list-disc list-inside text-gray-600 mb-4">
                            <li><strong>For Loop:</strong> Used when you know <em>exactly</em> how many times you want to repeat something.</li>
                            <li><strong>While Loop:</strong> Used when you want to repeat something <em>until a condition changes to False</em>. (Warning: If the condition never turns False, the loop runs forever and crashes your program!)</li>
                        </ul>
                        
                        <h3 class="text-xl font-bold mt-6 mb-2 text-gray-800">Code Example: Looping</h3>
                        <div class="bg-slate-900 rounded-md p-4 mb-4">
                            <pre><code class="text-green-400"># 1. The For Loop using range()
# range(5) generates numbers 0, 1, 2, 3, 4. (It stops BEFORE 5).
for count in range(5):
    print(f"Counting: {count}")

# 2. The While Loop
battery = 3
while battery > 0:
    print("Device is running...")
    # We must decrease the battery, or this loops forever!
    battery -= 1  # This is a shortcut for: battery = battery - 1

print("Device powered off.")

# 3. Escaping a loop early
for i in range(10):
    if i == 5:
        break  # The 'break' command instantly destroys the loop!
    print(i) # Prints 0, 1, 2, 3, 4 then stops completely.</code></pre>
                        </div>
                    </div>

                    <!-- Section 7 -->
                    <div x-show="activeTab === 7" x-cloak>
                        <h1 class="text-3xl font-bold mb-4 text-gray-800 border-b pb-2">7. Basic Math Operations</h1>
                        
                        <h3 class="text-xl font-bold mt-6 mb-2 text-indigo-700">The Built-In Math Library</h3>
                        <p class="text-gray-600 mb-2">Python can do basic `+ - * /` out of the box. But for advanced calculations (like square roots, rounding up, or finding the sine of an angle), you need to import the `math` toolset. This connects your code to powerful math algorithms.</p>
                        <p class="text-gray-600 mb-4"><strong>Crucial Engineering Rule:</strong> When using trigonometry (sine, cosine, tangent), computers do not understand Degrees (like 90° or 180°). They only understand Radians. You must convert degrees to radians first!</p>
                        
                        <h3 class="text-xl font-bold mt-6 mb-2 text-gray-800">Code Example: Advanced Math</h3>
                        <div class="bg-slate-900 rounded-md p-4 mb-4">
                            <pre><code class="text-green-400">import math  # Must be put at the top of your file

# Advanced Math
print(math.sqrt(25))   # 5.0 (Square root)
print(math.pow(2, 3))  # 8.0 (2 to the power of 3)

# Rounding
print(math.ceil(4.1))  # 5 (Ceiling: Forces rounding UP)
print(math.floor(4.9)) # 4 (Floor: Forces rounding DOWN)

# Trigonometry (The Radians Trap)
degrees = 90
radians = math.radians(degrees) # Convert first!
print(math.sin(radians)) # 1.0</code></pre>
                        </div>
                    </div>

                    <!-- Section 8 -->
                    <div x-show="activeTab === 8" x-cloak>
                        <h1 class="text-3xl font-bold mb-4 text-gray-800 border-b pb-2">8. Strings</h1>
                        
                        <h3 class="text-xl font-bold mt-6 mb-2 text-indigo-700">Manipulating Text</h3>
                        <p class="text-gray-600 mb-2">A String is just a sequence of characters stored in memory. In Python, every character has a specific numbered position called an <strong>Index</strong>. By using square brackets `[]`, we can grab specific letters or slice out entire chunks of words.</p>
                        <p class="text-gray-600 mb-4"><strong>Important:</strong> Computers always start counting from 0. So the first letter is at index 0, the second letter is at index 1, and so on.</p>
                        
                        <h3 class="text-xl font-bold mt-6 mb-2 text-gray-800">Code Example: Slicing and Cleaning</h3>
                        <div class="bg-slate-900 rounded-md p-4 mb-4">
                            <pre><code class="text-green-400">text = "Python"

# 1. Indexing (Grabbing single letters)
print(text[0])   # 'P'
print(text[-1])  # 'n' (Negative 1 grabs the very last letter!)

# 2. Slicing [start : stop]
# It grabs letters starting at index 0, and stops BEFORE index 4.
print(text[0:4]) # 'Pyth' 

# 3. String Methods (Built-in tools to clean text)
greeting = "  Hello World  "
clean = greeting.strip() # Removes empty spaces on the sides
print(clean.upper())     # "HELLO WORLD"

# 4. Splitting text into a list of words
sentence = "apple,banana,orange"
fruits = sentence.split(",") # Creates a list: ['apple', 'banana', 'orange']</code></pre>
                        </div>
                    </div>

                    <!-- Section 9 -->
                    <div x-show="activeTab === 9" x-cloak>
                        <h1 class="text-3xl font-bold mb-4 text-gray-800 border-b pb-2">9. Lists (Arrays)</h1>
                        
                        <h3 class="text-xl font-bold mt-6 mb-2 text-indigo-700">The Ultimate Data Storage</h3>
                        <p class="text-gray-600 mb-2">Variables are great for storing one thing, but what if you have 100 student scores? Instead of making 100 variables, we use a <strong>List</strong>. A List is like a filing cabinet where you can store multiple items in order.</p>
                        <p class="text-gray-600 mb-4">Like Strings, Lists are ordered by an Index starting at 0. However, unlike Strings, Lists are <strong>mutable</strong>, meaning you can easily overwrite, add, or remove items at any time.</p>
                        
                        <h3 class="text-xl font-bold mt-6 mb-2 text-gray-800">Code Example: Managing Lists</h3>
                        <div class="bg-slate-900 rounded-md p-4 mb-4">
                            <pre><code class="text-green-400"># Created using square brackets []
scores = [85, 92, 78]

# 1. Accessing and Overwriting
print(scores[0])  # 85
scores[0] = 90    # Changes the first score from 85 to 90

# 2. Adding Items (Appends to the very end)
scores.append(100) # Now the list is [90, 92, 78, 100]

# 3. Removing Items
scores.pop()      # Removes and returns the last item (100)
scores.remove(92) # Searches for the number 92 and deletes it

# 4. List Math (Super fast built-in tools!)
print(len(scores)) # How many items are in the list? (Answers 2)
print(max(scores)) # The highest number (90)
print(sum(scores)) # Adds them all up (168)</code></pre>
                        </div>
                    </div>

                    <!-- Section 10 -->
                    <div x-show="activeTab === 10" x-cloak>
                        <h1 class="text-3xl font-bold mb-4 text-gray-800 border-b pb-2">10. Basic Functions</h1>
                        
                        <h3 class="text-xl font-bold mt-6 mb-2 text-indigo-700">Don't Repeat Yourself (DRY)</h3>
                        <p class="text-gray-600 mb-2">If you find yourself copying and pasting the exact same math formula 5 times in your code, you should create a Function. A Function is a mini-machine you build. You define it once, and then you can use it over and over.</p>
                        <p class="text-gray-600 mb-4">Functions take inputs (called <strong>Parameters</strong>), do some work, and then spit out an answer (using the <strong>return</strong> keyword).</p>
                        
                        <h3 class="text-xl font-bold mt-6 mb-2 text-gray-800">Code Example: Building a Mini-Machine</h3>
                        <div class="bg-slate-900 rounded-md p-4 mb-4">
                            <pre><code class="text-green-400"># 'def' stands for Define. We are defining a new machine.
# 'width' and 'height' are the inputs we expect.
def calculate_area(width, height):
    area = width * height
    return area  # Sends the final answer back to the main code!

# Now the machine is built. Let's use it!
# We pass in 5 and 10 as our arguments.
room1_area = calculate_area(5, 10)
room2_area = calculate_area(20, 20)

print(f"Room 1 is {room1_area} sq ft.") # 50
print(f"Room 2 is {room2_area} sq ft.") # 400</code></pre>
                        </div>
                    </div>

                    <!-- Section 11 -->
                    <div x-show="activeTab === 11" x-cloak>
                        <h1 class="text-3xl font-bold mb-4 text-gray-800 border-b pb-2">11. Type Conversion</h1>
                        
                        <h3 class="text-xl font-bold mt-6 mb-2 text-indigo-700">Forcing Data to Change Shapes</h3>
                        <p class="text-gray-600 mb-2">Python is strictly typed. It refuses to magically combine text and math. For example, trying to do <code>"Your score is " + 50</code> will crash your program. You must manually convert the number 50 into text before joining them.</p>
                        <p class="text-gray-600 mb-4">We do this using conversion functions: <code>str()</code> for text, <code>int()</code> for whole numbers, and <code>float()</code> for decimals. This is called "Casting".</p>
                        
                        <h3 class="text-xl font-bold mt-6 mb-2 text-gray-800">Code Example: Casting</h3>
                        <div class="bg-slate-900 rounded-md p-4 mb-4">
                            <pre><code class="text-green-400">text_number = "50"

# 1. String to Integer
real_number = int(text_number)
print(real_number * 2)  # 100 (Math works!)

# 2. Number to String
age = 25
# print("I am " + age) # CRASH! TypeError
print("I am " + str(age)) # Works!

# 3. String to Float
decimal = float("19.99")
print(decimal + 1) # 20.99

# Warning: If you try to convert words into numbers (like int("Hello")),
# Python will throw a ValueError and crash!</code></pre>
                        </div>
                    </div>

                    <!-- Section 12 -->
                    <div x-show="activeTab === 12" x-cloak>
                        <h1 class="text-3xl font-bold mb-4 text-gray-800 border-b pb-2">12. Dictionaries</h1>
                        
                        <h3 class="text-xl font-bold mt-6 mb-2 text-indigo-700">The Power of Key-Value Pairs</h3>
                        <p class="text-gray-600 mb-2">Imagine trying to find "Alice's" phone number in a messy list of a million people. It would take forever to scan one by one. A <strong>Dictionary</strong> solves this. It stores data in pairs: a Key (like a name) and a Value (like a phone number).</p>
                        <p class="text-gray-600 mb-4">Under the hood, Dictionaries use complex math (Hash Tables) to instantly jump to the exact location of the data. Searching for a Key in a Dictionary is instantaneous, no matter how big the dictionary gets!</p>
                        
                        <h3 class="text-xl font-bold mt-6 mb-2 text-gray-800">Code Example: Instant Lookups</h3>
                        <div class="bg-slate-900 rounded-md p-4 mb-4">
                            <pre><code class="text-green-400"># Created using curly braces {}
# Format is "Key": Value
student_scores = {
    "Alice": 95,
    "Bob": 82
}

# 1. Instant Lookup
print(student_scores["Alice"])  # 95

# 2. Adding or Updating
student_scores["Charlie"] = 88  # Adds Charlie
student_scores["Bob"] = 90      # Updates Bob's score to 90

# 3. Safe Checking
# If you ask for a key that doesn't exist, Python crashes.
# Always check if it exists first!
if "Dave" in student_scores:
    print(student_scores["Dave"])
else:
    print("Dave is not in the system.")</code></pre>
                        </div>
                    </div>

                    <!-- Section 13 -->
                    <div x-show="activeTab === 13" x-cloak>
                        <h1 class="text-3xl font-bold mb-4 text-gray-800 border-b pb-2">13. Sets</h1>
                        
                        <h3 class="text-xl font-bold mt-6 mb-2 text-indigo-700">Removing Duplicates Instantly</h3>
                        <p class="text-gray-600 mb-2">A Set is like a bag where <strong>every item must be entirely unique</strong>. If you try to put a duplicate item into the bag, it just ignores it. It works exactly like a Dictionary, but without the "Values".</p>
                        <p class="text-gray-600 mb-4">Because they share the same instant-lookup magic as dictionaries, Sets are the ultimate tool for quickly removing duplicates from a List or checking if an item exists.</p>
                        
                        <h3 class="text-xl font-bold mt-6 mb-2 text-gray-800">Code Example: Unique Data</h3>
                        <div class="bg-slate-900 rounded-md p-4 mb-4">
                            <pre><code class="text-green-400"># Creating a Set
valid_ids = {101, 102, 103}

# Adding a duplicate does absolutely nothing
valid_ids.add(101)
print(valid_ids) # {101, 102, 103}

# THE MAGIC TRICK: Removing duplicates from a messy list
messy_list = [1, 2, 2, 3, 3, 3, 4]

# Convert the list to a Set (which destroys duplicates instantly)
# Then convert it back to a List!
clean_list = list(set(messy_list))

print(clean_list) # [1, 2, 3, 4]</code></pre>
                        </div>
                    </div>

                    <!-- Section 14 -->
                    <div x-show="activeTab === 14" x-cloak>
                        <h1 class="text-3xl font-bold mb-4 text-gray-800 border-b pb-2">14. Tuples</h1>
                        
                        <h3 class="text-xl font-bold mt-6 mb-2 text-indigo-700">Unchangeable Lists</h3>
                        <p class="text-gray-600 mb-2">A Tuple is exactly like a List, but with one massive difference: it is <strong>immutable (cannot be changed)</strong>. Once you create a tuple, it is locked forever. You cannot add, remove, or modify items inside it.</p>
                        <p class="text-gray-600 mb-4">Why use them? Because they never change, the computer doesn't need to prepare extra memory for them. Tuples are faster and take up less memory than Lists. They are perfect for fixed data like map coordinates (x, y).</p>
                        
                        <h3 class="text-xl font-bold mt-6 mb-2 text-gray-800">Code Example: Tuples and Unpacking</h3>
                        <div class="bg-slate-900 rounded-md p-4 mb-4">
                            <pre><code class="text-green-400"># Created using parentheses ()
player_location = (10, 20)

# player_location[0] = 15  # ERROR! You cannot change a tuple!

# Unpacking: A neat trick to assign multiple variables at once
x, y = player_location
print(f"Player is at X: {x}, Y: {y}")

# Functions can use Tuples to return multiple answers at once!
def get_min_and_max(arr):
    return (min(arr), max(arr))

lowest, highest = get_min_and_max([5, 2, 9])
print(lowest)  # 2
print(highest) # 9</code></pre>
                        </div>
                    </div>

                    <!-- Section 15 -->
                    <div x-show="activeTab === 15" x-cloak>
                        <h1 class="text-3xl font-bold mb-4 text-gray-800 border-b pb-2">15. List Comprehensions</h1>
                        
                        <h3 class="text-xl font-bold mt-6 mb-2 text-indigo-700">The 1-Line Loop Trick</h3>
                        <p class="text-gray-600 mb-2">List Comprehensions are a "Python Superpower". They allow you to write a `for loop` inside a List to generate data on a single line of code.</p>
                        <p class="text-gray-600 mb-4">Not only does this look incredibly clean, but it is actually processed much faster by the computer than writing out a normal multi-line loop.</p>
                        
                        <h3 class="text-xl font-bold mt-6 mb-2 text-gray-800">Code Example: The Pythonic Way</h3>
                        <div class="bg-slate-900 rounded-md p-4 mb-4">
                            <pre><code class="text-green-400">numbers = [1, 2, 3, 4, 5]

# --- The Old Way (4 lines) ---
doubled = []
for n in numbers:
    doubled.append(n * 2)

# --- The Pythonic Way (1 line) ---
# Format: [ do_this for item in list ]
doubled_fast = [n * 2 for n in numbers]

# You can even add an 'if' statement to filter data!
# Let's grab only the Even numbers:
evens = [n for n in numbers if n % 2 == 0]
print(evens) # [2, 4]</code></pre>
                        </div>
                    </div>

                    <!-- Section 16 -->
                    <div x-show="activeTab === 16" x-cloak>
                        <h1 class="text-3xl font-bold mb-4 text-gray-800 border-b pb-2">16. Fast I/O</h1>
                        
                        <h3 class="text-xl font-bold mt-6 mb-2 text-indigo-700">Preventing Time Limit Exceeded (TLE)</h3>
                        <p class="text-gray-600 mb-2">In competitive programming (like this Online Judge), your code is timed. The standard `input()` function is very slow. If a problem gives you 100,000 lines of data, calling `input()` 100,000 times will freeze your program and cause a Time Limit Exceeded (TLE) failure.</p>
                        <p class="text-gray-600 mb-4">The secret is to use <code>sys.stdin.read()</code>, which grabs the entire document of data in one massive, instant gulp.</p>
                        
                        <h3 class="text-xl font-bold mt-6 mb-2 text-gray-800">Code Example: The Fast Setup</h3>
                        <div class="bg-slate-900 rounded-md p-4 mb-4">
                            <pre><code class="text-green-400">import sys

# Read EVERYTHING the user typed all at once.
# .split() automatically breaks it into a list of words/numbers,
# ignoring all spaces and newlines perfectly!
data = sys.stdin.read().split()

# Now 'data' is a list: ['10', '5', '99', ...]
if len(data) > 0:
    # Remember to convert the text to integers!
    first_number = int(data[0])
    second_number = int(data[1])
    
    print(first_number + second_number)</code></pre>
                        </div>
                    </div>

                    <!-- Section 17 -->
                    <div x-show="activeTab === 17" x-cloak>
                        <h1 class="text-3xl font-bold mb-4 text-gray-800 border-b pb-2">17. Sorting</h1>
                        
                        <h3 class="text-xl font-bold mt-6 mb-2 text-indigo-700">Ordering Your Data</h3>
                        <p class="text-gray-600 mb-2">Sorting data from smallest to largest is required for countless algorithms. Python has a highly optimized sorting engine built right in. It is so fast that you should almost never try to write your own sorting code.</p>
                        <p class="text-gray-600 mb-4">You can sort lists of numbers, alphabetical strings, or even complex lists of lists by telling Python exactly which part to look at.</p>
                        
                        <h3 class="text-xl font-bold mt-6 mb-2 text-gray-800">Code Example: Sorting Tricks</h3>
                        <div class="bg-slate-900 rounded-md p-4 mb-4">
                            <pre><code class="text-green-400">numbers = [5, 2, 9, 1]

# Sorts smallest to largest (Modifies the list directly)
numbers.sort()
print(numbers) # [1, 2, 5, 9]

# Sorts largest to smallest
numbers.sort(reverse=True)

# --- Advanced Custom Sorting ---
# Imagine a list of students: [Name, Score]
students = [["Alice", 85], ["Bob", 92], ["Charlie", 78]]

# How do we sort them by score?
# 'lambda x: x[1]' tells Python: "For each student, look at index 1 (the score)"
students.sort(key=lambda x: x[1])

print(students) # Charlie(78), Alice(85), Bob(92)</code></pre>
                        </div>
                    </div>

                    <!-- Section 18 -->
                    <div x-show="activeTab === 18" x-cloak>
                        <h1 class="text-3xl font-bold mb-4 text-gray-800 border-b pb-2">18. Built-in Tools</h1>
                        
                        <h3 class="text-xl font-bold mt-6 mb-2 text-indigo-700">Python's Secret Weapons</h3>
                        <p class="text-gray-600 mb-2">Python is famous for being "batteries included". If you need to solve a common problem, Python probably already has a highly-optimized tool built for it. Using these tools will save you hours of coding and make your code run significantly faster.</p>
                        
                        <h3 class="text-xl font-bold mt-6 mb-2 text-gray-800">Code Example: The Best Tools</h3>
                        <div class="bg-slate-900 rounded-md p-4 mb-4">
                            <pre><code class="text-green-400"># 1. Counter (Instantly count how many times things appear)
from collections import Counter
votes = ["A", "B", "A", "C", "B", "A"]
# This creates a dictionary counting everything!
print(Counter(votes))  # {'A': 3, 'B': 2, 'C': 1}

# 2. Deque (A Double-Ended Queue)
# Removing the first element of a normal List (list.pop(0)) is very slow.
# A Deque is a special list that is lightning fast from BOTH sides.
from collections import deque
queue = deque([1, 2, 3])
queue.popleft()  # Instantly removes the '1'. 

# 3. Math GCD (Greatest Common Divisor)
import math
print(math.gcd(24, 36)) # 12</code></pre>
                        </div>
                    </div>

                    <!-- Section 19 -->
                    <div x-show="activeTab === 19" x-cloak>
                        <h1 class="text-3xl font-bold mb-4 text-gray-800 border-b pb-2">19. 2D Arrays (Grids)</h1>
                        
                        <h3 class="text-xl font-bold mt-6 mb-2 text-indigo-700">Lists inside Lists</h3>
                        <p class="text-gray-600 mb-2">When programming maps, game boards, or matrices, you need a 2D Array. In Python, this is simply a List where every item inside it is another List.</p>
                        <p class="text-gray-600 mb-4"><strong>The Danger:</strong> Never create a grid by multiplying a list like this: `grid = [[0]*3]*3`. Python uses memory references, so this creates 3 rows that all point to the exact same memory! Changing row 1 will magically corrupt row 2. You must use a loop to build them safely.</p>
                        
                        <h3 class="text-xl font-bold mt-6 mb-2 text-gray-800">Code Example: Building a Safe Grid</h3>
                        <div class="bg-slate-900 rounded-md p-4 mb-4">
                            <pre><code class="text-green-400">rows = 3
cols = 3

# The SAFE way to build a 3x3 grid of zeroes using List Comprehension
grid = [[0 for c in range(cols)] for r in range(rows)]

# Accessing [Row][Column]
grid[0][1] = 5

# Printing the grid beautifully
for row in grid:
    print(row)

# Output:
# [0, 5, 0]
# [0, 0, 0]
# [0, 0, 0]</code></pre>
                        </div>
                    </div>

                    <!-- Section 20 -->
                    <div x-show="activeTab === 20" x-cloak>
                        <h1 class="text-3xl font-bold mb-4 text-gray-800 border-b pb-2">20. Time Complexity (Big-O)</h1>
                        
                        <h3 class="text-xl font-bold mt-6 mb-2 text-indigo-700">Why did my code fail the speed test?</h3>
                        <p class="text-gray-600 mb-2">When solving algorithmic problems, your code isn't just tested for correctness, it is tested for speed. We measure speed using "Big-O Notation", which asks: "If the input size grows to 100,000, how many steps does the computer take to finish?"</p>
                        <ul class="list-disc list-inside text-gray-600 mb-4">
                            <li><strong>$O(1)$ - Constant Time (Instant):</strong> Like looking up a Dictionary Key. Takes 1 step.</li>
                            <li><strong>$O(N)$ - Linear Time (Fast):</strong> Like a single `for loop`. 100,000 items = 100,000 steps.</li>
                            <li><strong>$O(N^2)$ - Quadratic Time (Danger!):</strong> A loop inside a loop. 100,000 items = 10 BILLION steps. Your program will crash with a TLE (Time Limit Exceeded) error.</li>
                        </ul>
                        
                        <h3 class="text-xl font-bold mt-6 mb-2 text-gray-800">Code Example: Slow vs Fast</h3>
                        <div class="bg-slate-900 rounded-md p-4 mb-4">
                            <pre><code class="text-green-400"># SLOW: O(N^2) Approach. 
# A loop inside a loop. Will fail if the array has thousands of items.
def find_duplicate_slow(arr):
    for i in range(len(arr)):
        for j in range(i + 1, len(arr)):
            if arr[i] == arr[j]:
                return True

# FAST: O(N) Approach.
# One single loop. The Set lookup is O(1) instant! Will pass 100% of time.
def find_duplicate_fast(arr):
    seen = set()
    for item in arr:
        if item in seen:
            return True
        seen.add(item)</code></pre>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    
    <style>
        [x-cloak] { display: none !important; }
        
        /* Custom scrollbar for an integrated reading experience */
        .overflow-y-auto::-webkit-scrollbar { width: 8px; }
        .overflow-y-auto::-webkit-scrollbar-track { background: #f8fafc; border-radius: 4px; }
        .overflow-y-auto::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        .overflow-y-auto::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</x-app-layout>
