import 'package:flutter/material.dart';

import 'recipe_prep_screen.dart';

/* 
  TODO: We need 3 packages to install from pub.dev
    1. google_fonts: ^6.2.1 (https://pub.dev/packages/google_fonts)
    2. google_generative_ai: ^0.4.6 (https://pub.dev/packages/google_generative_ai)
    3. image_picker: ^0.8.4+4 (https://pub.dev/packages/image_picker)
*/

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Flutter Demo',
      theme: ThemeData(
        colorScheme: ColorScheme.fromSeed(seedColor: Colors.green),
        useMaterial3: false,
      ),
      home: const RecipePrepScreen(),
    );
  }
}
