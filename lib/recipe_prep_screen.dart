import 'dart:developer';
import 'dart:io';

import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:google_generative_ai/google_generative_ai.dart';
import 'package:image_picker/image_picker.dart';

class RecipePrepScreen extends StatefulWidget {
  const RecipePrepScreen({super.key});

  @override
  State<RecipePrepScreen> createState() => _RecipePrepScreenState();
}

class _RecipePrepScreenState extends State<RecipePrepScreen> {
  int maxPeople = 1; // 1 people
  int maxTimeCooking = 15; // 10 minutes
  final textController = TextEditingController();
  XFile? image;
  bool isLoading = false;

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Recipe by AI',
            style: GoogleFonts.notoSans(color: Colors.white, fontSize: 18.0)),
        centerTitle: true,
        backgroundColor: Colors.lightGreen,
      ),
      body: SingleChildScrollView(
        child: Padding(
          padding: const EdgeInsets.all(20),
          child: Column(
            children: [
              Text(
                "How many people are you cooking for?",
                style: Theme.of(context).textTheme.bodyLarge?.copyWith(
                      fontWeight: FontWeight.bold,
                    ),
              ),
              Slider(
                divisions: 3,
                label: "$maxPeople people",
                value: maxPeople.toDouble(),
                min: 1,
                max: 4,
                activeColor: Colors.lightGreen,
                onChanged: (double value) {
                  setState(() {
                    maxPeople = value.toInt();
                  });
                },
              ),
              const SizedBox(height: 30),
              SegmentedButton(
                  multiSelectionEnabled: false,
                  segments: const [
                    ButtonSegment(label: Text("15 m"), value: 15),
                    ButtonSegment(label: Text("30 m"), value: 30),
                    ButtonSegment(label: Text("45 m"), value: 45),
                    ButtonSegment(label: Text("60 m"), value: 60),
                  ],
                  selected: {maxTimeCooking},
                  onSelectionChanged: (selections) {
                    setState(() {
                      maxTimeCooking = selections.first;
                    });
                  }),
              const SizedBox(height: 30),
              Padding(
                padding: const EdgeInsets.symmetric(horizontal: 30),
                child: TextFormField(
                  controller: textController,
                  decoration: const InputDecoration(
                      hintText: 'Do you have any intolerance? (Optional)'),
                ),
              ),
              const SizedBox(height: 50),
              GestureDetector(
                onTap: () {
                  imagePickerMethod();
                },
                child: SizedBox(
                  height: 300,
                  width: 300,
                  child: image != null
                      ? Image.file(File(image!.path))
                      : Image.asset('assets/images/pick_image.png'),
                ),
              ),
              const SizedBox(height: 100),
              ElevatedButton(
                onPressed: () async {
                  setState(() {
                    isLoading = true;
                  });
                  try {
                    var recipe = await generationRecipeByGeminiMethod(
                        maxPeople, maxTimeCooking, textController.text, image);
                    openButtomBar(recipe);
                  } catch (e) {
                    log(e.toString());

                    ScaffoldMessenger.of(context).showSnackBar(
                        const SnackBar(content: Text('Something went wrong')));
                  }

                  setState(() {
                    isLoading = false;
                  });
                },
                style: ElevatedButton.styleFrom(fixedSize: const Size(400, 40)),
                child: isLoading
                    ? CircularProgressIndicator(color: Colors.white)
                    : Text('Generate by AI'),
              )
            ],
          ),
        ),
      ),
    );
  }

  // Show loading
  void showLoading() {
    setState(() {
      isLoading = true;
    });
  }

  // Hide loading
  void hideLoading() {
    setState(() {
      isLoading = false;
    });
  }

  // Method to pick image from gallery
  Future<void> imagePickerMethod() async {
    final picker = await ImagePicker().pickImage(source: ImageSource.gallery);

    if (picker != null) {
      setState(() {
        image = picker;
      });
    }
  }

  // Method to open bottom bar
  void openButtomBar(var recipe) {
    showModalBottomSheet(
        context: context,
        builder: (BuildContext context) {
          return SingleChildScrollView(
            child: Padding(
              padding: const EdgeInsets.all(10),
              child: Text(recipe.toString()),
            ),
          );
        });
  }

  // Method to generate recipe by Gemini
  Future<List<String>> generationRecipeByGeminiMethod(int people,
      int maxTimeCooking, String? intoleranceOrLimits, XFile? picture) async {
    final model = GenerativeModel(
      model: 'gemini-1.5-pro',
      apiKey: 'AIzaSyC7nmB9-_Ed3MefvDdW1gHPSmw_mS7i3JM',
    );

    final prompt = _generatePrompt(people, maxTimeCooking, intoleranceOrLimits);
    final image = await picture!.readAsBytes();
    final mimetype = picture.mimeType ?? 'image/jpeg';

    final response = await model.generateContent([
      Content.multi([TextPart(prompt), DataPart(mimetype, image)])
    ]);

    // return response.skipWhile((response) => response.text != null).map((event) => event.text!);
    log(response.text!);
    return [response.text!];
  }

  // Method to generate prompt
  String _generatePrompt(
      int people, int maxTimeCooking, String? intoleranceOrLimits) {
    String prompt =
        '''You are a very experienced diet Planner. I want to have a 3 options for a meal using only the ingredients in the picture. 
  I need the receipt step by step to easily understand it and format me using only markdown. 
  I want the quantity of the ingredients for ${people.toString()} people and I only want to spend a maximum of ${maxTimeCooking.toString()} minutes to make the meal.
  ''';

    if (intoleranceOrLimits != null) {
      prompt +=
          'I have the following intolerances or limits: $intoleranceOrLimits';
    }

    return prompt;
  }
}
